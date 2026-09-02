<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function index(Request $request): View
    {
        $query = Media::latest();

        if ($request->filled('folder')) {
            $query->where('folder', $request->folder);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('alt_text', 'like', '%' . $request->search . '%');
            });
        }

        $media = $query->paginate(30);
        $folders = Media::select('folder')->whereNotNull('folder')->distinct()->pluck('folder');

        if ($request->ajax()) {
            return response()->json([
                'items' => $media->map(fn($m) => [
                    'id' => $m->id,
                    'url' => $m->url,
                    'name' => $m->name,
                    'file_name' => $m->file_name,
                    'size' => number_format($m->size / 1024, 1) . ' KB',
                    'folder' => $m->folder,
                ]),
                'has_more' => $media->hasMorePages(),
                'next_page' => $media->currentPage() + 1,
            ]);
        }

        return view('admin.media.index', compact('media', 'folders'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'folder' => 'nullable|string|max:100',
            'alt_text' => 'nullable|string|max:255',
            'credit' => 'nullable|string|max:255',
        ]);

        $file = $request->file('file');
        $folder = $request->folder ?? 'general';
        $path = $file->store('media/' . $folder, 'public');

        Media::create([
            'name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'file_name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'folder' => $folder,
            'alt_text' => $request->alt_text,
            'credit' => $request->credit,
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()->route('admin.media.index')->with('success', 'ছবি আপলোড করা হয়েছে!');
    }

    public function update(Request $request, Media $medium): RedirectResponse
    {
        $request->validate([
            'alt_text' => 'nullable|string|max:255',
            'credit' => 'nullable|string|max:255',
        ]);

        $medium->update($request->only(['alt_text', 'credit']));

        return redirect()->route('admin.media.index')->with('success', 'তথ্য আপডেট হয়েছে!');
    }

    public function destroy(Media $medium): RedirectResponse
    {
        Storage::disk('public')->delete($medium->path);
        $medium->delete();

        return redirect()->route('admin.media.index')->with('success', 'ছবি মুছে ফেলা হয়েছে!');
    }
}
