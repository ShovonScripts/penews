@extends('layouts.app')

@section('title', 'অনুসন্ধান - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    {{-- Header --}}
    <div class="mb-6 pb-4 border-b border-[#e0e0e0] dark:border-[#333]">
        <h1 class="text-2xl md:text-3xl font-bold text-[#0d0d0d] dark:text-white">
            <span class="inline-block w-1 h-5 bg-[#E02020] align-middle mr-2"></span>
            অনুসন্ধান
        </h1>
    </div>

    {{-- Search Form --}}
    <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] mb-6">
        <form method="GET" action="{{ route('search.index') }}">
            <div class="flex border-b border-[#e0e0e0] dark:border-[#333]">
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="কীওয়ার্ড লিখুন..."
                    class="flex-1 border-0 px-4 py-3.5 text-base focus:outline-none focus:ring-0 bg-transparent dark:text-[#e0e0e0] placeholder-[#999] dark:placeholder-[#666]">
                <button type="submit"
                    class="bg-[#0d0d0d] dark:bg-[#333] text-white px-6 font-medium hover:bg-black/80 dark:hover:bg-[#444] transition flex items-center gap-2 text-sm">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    অনুসন্ধান
                </button>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-0 divide-x divide-[#e0e0e0] dark:divide-[#333]">
                <select name="category"
                    class="border-0 px-3 py-2.5 text-sm focus:outline-none focus:ring-0 bg-transparent dark:text-[#e0e0e0] dark:[color-scheme:dark]">
                    <option value="">সব বিভাগ</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name_bn }}</option>
                    @endforeach
                </select>
                <select name="district"
                    class="border-0 px-3 py-2.5 text-sm focus:outline-none focus:ring-0 bg-transparent dark:text-[#e0e0e0] dark:[color-scheme:dark]">
                    <option value="">সব জেলা</option>
                    @foreach($districts as $d)
                    <option value="{{ $d->id }}" @selected(request('district') == $d->id)>{{ $d->name_bn }}</option>
                    @endforeach
                </select>
                <input type="date" name="from" value="{{ request('from') }}"
                    class="border-0 px-3 py-2.5 text-sm focus:outline-none focus:ring-0 bg-transparent dark:text-[#e0e0e0] dark:[color-scheme:dark]">
                <input type="date" name="to" value="{{ request('to') }}"
                    class="border-0 px-3 py-2.5 text-sm focus:outline-none focus:ring-0 bg-transparent dark:text-[#e0e0e0] dark:[color-scheme:dark]">
            </div>
        </form>
    </div>

    {{-- Active Filters --}}
    @php $hasSearch = request()->filled('q') || request()->filled('category') || request()->filled('district') || request()->filled('from') || request()->filled('to'); @endphp

    @if($hasSearch)
        @if($articles->isEmpty())
            <div class="text-center py-16 bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333]">
                <svg class="h-12 w-12 text-[#ccc] dark:text-[#444] mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <p class="text-[#999] dark:text-[#777]">কোনো ফলাফল পাওয়া যায়নি।</p>
                <p class="text-xs text-[#bbb] dark:text-[#555] mt-1">অনুগ্রহ করে ভিন্ন কীওয়ার্ড দিয়ে অনুসন্ধান করুন।</p>
            </div>
        @else
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-8">
                <p class="text-sm text-[#666] dark:text-[#999] mb-4">{{ $articles->total() }}টি ফলাফল পাওয়া গেছে</p>
                <div class="space-y-3">
                    @foreach($articles as $article)
                    <a href="{{ route('article.show', $article->slug) }}" class="group block bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                        <div class="flex gap-3 p-3">
                            @if($article->has_video || $article->featured_image)
                            <div class="w-[100px] shrink-0 aspect-[4/3] bg-[#0d0d0d] dark:bg-[#1a1a1a] overflow-hidden relative">
                                @if($article->has_video)
                                @include('partials.youtube-embed', ['videoUrl' => $article->video_url, 'mode' => 'thumb'])
                                @else
                                <img src="{{ $article->featured_image }}" alt="" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                                @endif
                            </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                @if($article->category)
                                <span class="text-xs font-bold uppercase tracking-widest text-[#E02020]">{{ $article->category->name_bn }}</span>
                                @endif
                                <h2 class="text-base md:text-lg font-bold leading-snug mt-0.5 group-hover:text-[#E02020] transition-colors line-clamp-2">
                                    {{ $article->title_bn }}
                                </h2>
                                <p class="text-sm text-[#666] dark:text-[#999] mt-1 leading-relaxed line-clamp-2">{{ Str::limit($article->excerpt_bn ?? strip_tags($article->body_bn), 150) }}</p>
                                <p class="text-xs text-[#999] dark:text-[#777] mt-2">
                                    @if($article->staffs->isNotEmpty())
                                    <span>@foreach($article->staffs as $i => $s)@if($i>0), @endif<a href="{{ route('staff.articles', $s) }}" class="hover:text-[#E02020] transition">{{ $s->name_bn }}</a>@endforeach &nbsp;•&nbsp;</span>
                                    @endif
                                    {{ $article->published_at?->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </a>
                    @if($loop->iteration % 5 === 0 && !$loop->last)
                        @include('partials.ads.article-bottom')
                    @endif
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $articles->links() }}
                </div>
            </div>

            <aside class="lg:col-span-4 space-y-6">
                @include('partials.ads.sidebar')
            </aside>
        </div>
        @endif
    @else
        <div class="text-center py-16 bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333]">
            <svg class="h-16 w-16 text-[#ddd] dark:text-[#444] mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <p class="text-[#999] dark:text-[#777]">কীওয়ার্ড লিখুন অথবা ফিল্টার ব্যবহার করুন।</p>
        </div>
    @endif
</div>
@endsection