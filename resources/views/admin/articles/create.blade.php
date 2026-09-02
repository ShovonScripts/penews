@extends('layouts.admin')
@section('title', 'নতুন আর্টিকেল')
@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.articles.index') }}" class="text-xs text-[#999] hover:text-[#0d0d0d] transition"><span class="flex items-center gap-1"><svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg> ফিরে যান</span></a>
    </div>
    <h1 class="font-['Playfair_Display'] text-2xl font-bold mb-6">নতুন আর্টিকেল</h1>
    <div class="bg-white dark:bg-[#1a1a1a] border border-[#e0e0e0] dark:border-[#333] p-6 md:p-8">
        <form method="POST" action="{{ route('admin.articles.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-[#666] dark:text-[#aaa] mb-1">শিরোনাম (বাংলা) *</label>
                <input type="text" name="title_bn" value="{{ old('title_bn') }}" required
                    class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#222] dark:text-[#eee] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-white">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#aaa] mb-1">বিভাগ *</label>
                    <select name="category_id" required
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#222] dark:text-[#eee] px-4 py-2.5 text-sm bg-white focus:outline-none focus:border-[#0d0d0d] dark:focus:border-white">
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name_bn }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#aaa] mb-1">প্রতিবেদক (একাধিক নির্বাচন করতে ctrl+ক্লিক)</label>
                    <select name="staff_ids[]" multiple
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#222] dark:text-[#eee] px-4 py-2.5 text-sm bg-white focus:outline-none focus:border-[#0d0d0d] dark:focus:border-white min-h-[100px]">
                        @foreach($staff as $s)
                        <option value="{{ $s->id }}" @selected(in_array($s->id, old('staff_ids', [])))>{{ $s->name_bn }} — {{ $s->designation_bn }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#aaa] mb-1">জেলা</label>
                    <select name="district_id"
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#222] dark:text-[#eee] px-4 py-2.5 text-sm bg-white focus:outline-none focus:border-[#0d0d0d] dark:focus:border-white">
                        <option value="">—</option>
                        @foreach($districts as $d)
                        <option value="{{ $d->id }}">{{ $d->name_bn }}</option>
                        @endforeach
                    </select>
                </div>
                <div></div>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#666] dark:text-[#aaa] mb-1">সারসংক্ষেপ</label>
                <textarea name="excerpt_bn" rows="2"
                    class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#222] dark:text-[#eee] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-white">{{ old('excerpt_bn') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#666] dark:text-[#aaa] mb-1">বডি *</label>
                <textarea name="body_bn" data-editor required
                    class="w-full border border-[#e0e0e0] dark:border-[#444] px-4 py-2.5 text-sm">{{ old('body_bn') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#aaa] mb-1">ফিচারড ইমেজ URL</label>
                    <div class="flex gap-2">
                        <input type="text" name="featured_image" id="featuredImage" value="{{ old('featured_image') }}"
                            class="flex-1 border border-[#e0e0e0] dark:border-[#444] dark:bg-[#222] dark:text-[#eee] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-white">
                        <button type="button" onclick="window.mediaEditorCallback=function(u){document.getElementById('featuredImage').value=u;window.mediaEditorCallback=null};openMediaLibraryForEditor()" class="border border-[#e0e0e0] dark:border-[#444] px-3 py-2.5 text-sm hover:bg-[#f5f5f5] dark:hover:bg-[#333]" title="মিডিয়া থেকে নির্বাচন">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#aaa] mb-1">ইউটিউব ভিডিও লিংক</label>
                    <input type="text" name="video_url" value="{{ old('video_url') }}" placeholder="https://youtube.com/watch?v=..."
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#222] dark:text-[#eee] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-white">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#666] dark:text-[#aaa] mb-1">নির্ধারিত প্রকাশের সময়</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                    class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#222] dark:text-[#eee] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-white">
                <p class="text-xs text-[#999] mt-1">শুধুমাত্র নির্ধারিত প্রকাশের জন্য পূরণ করুন</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#666] dark:text-[#aaa] mb-1">ট্যাগ (কমা দিয়ে আলাদা করুন)</label>
                <input type="text" name="tags" value="{{ old('tags') }}"
                    class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#222] dark:text-[#eee] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-white">
            </div>
            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 text-sm text-[#666] dark:text-[#aaa]">
                    <input type="checkbox" name="is_breaking" value="1" class="accent-[#E02020]">
                    ব্রেকিং নিউজ
                </label>
                <label class="flex items-center gap-2 text-sm text-[#666] dark:text-[#aaa]">
                    <input type="checkbox" name="is_featured" value="1" class="accent-[#0d0d0d]">
                    ফিচারড
                </label>
                <label class="flex items-center gap-2 text-sm text-[#666] dark:text-[#aaa]">
                    <input type="checkbox" name="is_editor_pick" value="1" class="accent-[#0d0d0d]">
                    এডিটরস পিক
                </label>
            </div>
            <div class="flex gap-3 pt-4 border-t border-[#e0e0e0] dark:border-[#333]">
                <button type="submit" name="status" value="draft"
                    class="border border-[#0d0d0d] dark:border-white text-[#0d0d0d] dark:text-white px-6 py-2.5 text-sm font-medium hover:bg-[#f5f5f5] dark:hover:bg-[#333] transition">
                    খসড়া হিসেবে সংরক্ষণ
                </button>
                <button type="submit" name="status" value="published"
                    class="bg-[#E02020] text-white px-6 py-2.5 text-sm font-medium hover:bg-red-700 transition">
                    প্রকাশ করুন
                </button>
                <button type="submit" name="status" value="scheduled"
                    class="bg-blue-600 text-white px-6 py-2.5 text-sm font-medium hover:bg-blue-700 transition">
                    নির্ধারিত করুন
                </button>
            </div>
        </form>
    </div>
    <div class="mt-6 bg-white dark:bg-[#1a1a1a] border border-[#e0e0e0] dark:border-[#333] p-6 text-center">
        <p class="text-sm text-[#999]">SEO Analysis পোস্ট সেভ করার পর পাওয়া যাবে</p>
        <p class="text-xs text-[#999] mt-1">এডিট পেজে গিয়ে বিস্তারিত SEO বিশ্লেষণ দেখুন</p>
    </div>

<div id="mediaLibraryModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden">
    <div class="bg-white dark:bg-[#1a1a1a] w-full max-w-4xl mx-4 rounded shadow-xl max-h-[85vh] flex flex-col">
        <div class="flex items-center justify-between p-4 border-b border-[#e0e0e0] dark:border-[#333]">
            <h2 class="font-bold">মিডিয়া লাইব্রেরি</h2>
            <button type="button" onclick="closeMediaLibrary()" class="text-[#999] hover:text-[#0d0d0d] dark:hover:text-white">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-4" id="mediaLibraryGrid">
            <div class="text-center text-sm text-[#999] py-10">লোড হচ্ছে...</div>
        </div>
        <div class="flex justify-end gap-3 p-4 border-t border-[#e0e0e0] dark:border-[#333]">
            <button type="button" onclick="closeMediaLibrary()" class="btn-outline">বাতিল</button>
        </div>
    </div>
</div>
@endsection

@push('editor')
<x-head.editor-config/>
@endpush
