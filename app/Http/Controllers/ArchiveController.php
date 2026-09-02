<?php

namespace App\Http\Controllers;

use App\Models\ArchiveDocument;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArchiveController extends Controller
{
    public function index(Request $request): View
    {
        $years = ArchiveDocument::where('is_published', true)
            ->select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $subcategories = [
            'নিয়োগ', 'বেতন ও ভাতা', 'ছুটি', 'বদলি', 'পরীক্ষা', 'পাঠ্যক্রম'
        ];

        $query = ArchiveDocument::where('is_published', true);

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('subcategory')) {
            $query->where('subcategory', $request->subcategory);
        }

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title_bn', 'like', "%{$request->q}%")
                  ->orWhere('title_en', 'like', "%{$request->q}%");
            });
        }

        $documents = $query->latest()->paginate(20);

        return view('archive.index', compact('documents', 'years', 'subcategories'));
    }
}
