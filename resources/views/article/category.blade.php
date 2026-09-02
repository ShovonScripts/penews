@extends('layouts.app')

@section('title', $category->name_bn . ' - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    {{-- Header --}}
    <div class="mb-8 pb-6 border-b border-[#e0e0e0] dark:border-[#333]">
        <h1 class="font-['Playfair_Display'] text-3xl lg:text-4xl font-bold">{{ $category->name_bn }}</h1>
        @if($category->description)
        <p class="text-[#666] dark:text-[#999] mt-2">{{ $category->description }}</p>
        @endif
        <p class="text-xs text-[#999] dark:text-[#777] mt-2">{{ $articles->total() }} টি প্রকাশিত সংবাদ</p>
    </div>

    @if($articles->isEmpty())
        <div class="text-center py-16">
            <svg class="h-12 w-12 text-[#ccc] dark:text-[#444] mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            <p class="text-sm text-[#999] dark:text-[#777]">এই বিভাগে এখনো কোনো সংবাদ প্রকাশিত হয়নি।</p>
        </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($articles as $article)
                <a href="{{ route('article.show', $article->slug) }}" class="group {{ $loop->first ? 'md:col-span-2 md:grid md:grid-cols-2 md:gap-6' : '' }}">
                    <div class="aspect-[16/9] {{ $loop->first ? 'md:aspect-auto md:h-full md:min-h-[280px]' : '' }} bg-[#0d0d0d] dark:bg-[#1a1a1a] overflow-hidden relative mb-3">
                        @if($article->has_video)
                        @include('partials.youtube-embed', ['videoUrl' => $article->video_url, 'mode' => 'thumb'])
                        @elseif($article->featured_image)
                        <img src="{{ $article->featured_image }}" alt="" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        @endif
                    </div>
                    <div class="{{ $loop->first ? 'flex flex-col justify-center' : '' }}">
                        <h2 class="font-['Playfair_Display'] text-lg {{ $loop->first ? 'text-2xl lg:text-3xl' : '' }} font-bold leading-snug group-hover:text-[#E02020] transition-colors">
                            {{ $article->title_bn }}
                        </h2>
                        @if($article->excerpt_bn)
                        <p class="text-sm text-[#666] dark:text-[#999] mt-2 leading-relaxed">{{ Str::limit($article->excerpt_bn, $loop->first ? 200 : 120) }}</p>
                        @endif
                        <p class="text-xs text-[#999] dark:text-[#777] mt-2">
                            @if($article->staffs->isNotEmpty())
                            <span>@foreach($article->staffs as $i => $s)@if($i>0), @endif<a href="{{ route('staff.articles', $s) }}" class="hover:text-[#E02020] transition">{{ $s->name_bn }}</a>@endforeach &nbsp;•&nbsp;</span>
                            @endif
                            {{ $article->published_at?->diffForHumans() }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $articles->links() }}
            </div>
        </div>

        <aside class="lg:col-span-4 space-y-6">
            @include('partials.ads.sidebar')
        </aside>
    </div>
    @endif
</div>
@endsection
