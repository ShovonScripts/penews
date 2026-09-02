@extends('layouts.app')

@section('title', 'আর্কাইভ - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="mb-8 pb-6 border-b border-[#e0e0e0] dark:border-[#333]">
        <h1 class="font-serif text-3xl font-bold">PEN আর্কাইভ</h1>
        <p class="text-[#666] dark:text-[#999] mt-2">সার্কুলার, গেজেট নোটিফিকেশন, নীতি নির্ধারক দলিল ও অন্যান্য গুরুত্বপূর্ণ নথি</p>
    </div>

    {{-- Filters --}}
    <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-5 mb-8">
        <form method="GET" action="{{ route('archive.index') }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="নথি অনুসন্ধান..."
                    class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888]">
            </div>
            <select name="year"
                class="border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888]">
                <option value="">সব বছর</option>
                @foreach($years as $year)
                <option value="{{ $year }}" @selected(request('year') == $year)>{{ $year }}</option>
                @endforeach
            </select>
            <select name="subcategory"
                class="border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888]">
                <option value="">সব বিষয়</option>
                @foreach($subcategories as $sub)
                <option value="{{ $sub }}" @selected(request('subcategory') == $sub)>{{ $sub }}</option>
                @endforeach
            </select>
            <button type="submit"
                class="bg-[#0d0d0d] dark:bg-[#333] text-white px-6 py-2.5 text-sm font-medium hover:bg-black/80 dark:hover:bg-[#444] transition">
                অনুসন্ধান
            </button>
        </form>
    </div>

    {{-- Results --}}
    @if($documents->isEmpty())
        <div class="text-center py-16">
            <svg class="h-12 w-12 text-[#ccc] dark:text-[#444] mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <p class="text-sm text-[#999] dark:text-[#777]">কোনো নথি পাওয়া যায়নি।</p>
        </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8">
            <div class="space-y-3">
                @foreach($documents as $doc)
                <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-5 hover:border-[#999] dark:hover:border-[#555] transition flex items-start gap-4">
                    <div class="w-12 h-12 shrink-0 bg-[#f5f5f5] dark:bg-[#2a2a2a] flex items-center justify-center text-[#999] dark:text-[#777]">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-base">{{ $doc->title_bn }}</h3>
                        @if($doc->description_bn)
                        <p class="text-sm text-[#666] dark:text-[#999] mt-1">{{ Str::limit($doc->description_bn, 150) }}</p>
                        @endif
                        <div class="flex items-center gap-3 text-xs text-[#999] dark:text-[#777] mt-2">
                            <span>{{ $doc->year }}</span>
                            <span>•</span>
                            <span class="text-[#E02020] font-medium">{{ $doc->subcategory }}</span>
                            @if($doc->file_size)
                            <span>•</span>
                            <span>{{ round($doc->file_size / 1024, 1) }} KB</span>
                            @endif
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                        class="shrink-0 bg-[#0d0d0d] dark:bg-[#333] text-white px-5 py-2 text-sm font-medium hover:bg-black/80 dark:hover:bg-[#444] transition no-print flex items-center gap-2">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        ডাউনলোড
                    </a>
                </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $documents->withQueryString()->links() }}
            </div>
        </div>

        <aside class="lg:col-span-4 space-y-6">
            @include('partials.ads.sidebar')
        </aside>
    </div>
    @endif
</div>
@endsection
