@extends('layouts.admin')
@section('title', $titleBn . ' — এডিট')
@push('editor')
<x-head.editor-config/>
@endpush
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.pages.index') }}" class="text-xs text-[#999] hover:text-[#0d0d0d] dark:hover:text-white transition">
        <span class="flex items-center gap-1">
            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            ফিরে যান
        </span>
    </a>
</div>
<h1 class="font-['Playfair_Display'] text-2xl font-bold mb-6">{{ $titleBn }} <span class="text-sm font-normal text-[#999]">({{ $slug }})</span></h1>

<div class="bg-white dark:bg-[#1a1a1a] border border-[#e0e0e0] dark:border-[#333] p-6 md:p-8">
    <form method="POST" action="{{ route('admin.pages.update', $slug) }}">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-[#666] dark:text-[#aaa] mb-1">কন্টেন্ট</label>
            <textarea name="content" data-editor rows="20"
                class="w-full border border-[#e0e0e0] dark:border-[#444] px-4 py-2.5 text-sm">{{ old('content', $content) }}</textarea>
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class="btn-primary">সংরক্ষণ করুন</button>
        </div>
    </form>
</div>

<div id="mediaLibraryModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden">
    <div class="bg-white dark:bg-[#1a1a1a] w-full max-w-4xl mx-4 rounded shadow-xl max-h-[85vh] flex flex-col">
        <div class="flex items-center justify-between p-4 border-b border-[#e0e0e0] dark:border-[#333]">
            <h2 class="font-bold">মিডিয়া লাইব্রেরি</h2>
            <button type="button" onclick="closeMediaLibraryModal()" class="text-[#999] hover:text-[#0d0d0d] dark:hover:text-white">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-4" id="mediaLibraryGrid">
            <div class="text-center text-sm text-[#999] py-10">লোড হচ্ছে...</div>
        </div>
        <div class="flex justify-end gap-3 p-4 border-t border-[#e0e0e0] dark:border-[#333]">
            <button type="button" onclick="closeMediaLibraryModal()" class="btn-outline">বাতিল</button>
        </div>
    </div>
</div>
@endsection
