<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(): View
    {
        $user = Auth::user()->load(['district', 'comments.article', 'likedArticles' => function ($q) {
            $q->where('status', 'published')->latest('published_at');
        }]);

        $comments = $user->comments()->with('article')->latest()->paginate(10);
        $likedArticles = $user->likedArticles()->paginate(10);

        return view('profile.show', compact('user', 'comments', 'likedArticles'));
    }

    public function edit(): View
    {
        $user = Auth::user()->load('district');
        $districts = \App\Models\District::orderBy('name_bn')->get();

        return view('profile.edit', compact('user', 'districts'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|string|in:পুরুষ,নারী,অন্যান্য',
            'district_id' => 'nullable|exists:districts,id',
            'upazila' => 'nullable|string|max:255',
            'school_name' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'avatar' => 'nullable|url',
        ]);

        $user->update($validated);

        return redirect()->route('profile.show')
            ->with('success', 'প্রোফাইল আপডেট করা হয়েছে!');
    }
}
