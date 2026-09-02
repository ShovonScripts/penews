@extends('layouts.app')

@section('title', ($article->meta_title ?? $article->title_bn) . ' - ' . config('app.name'))
@section('meta_description', $article->meta_description ?? strip_tags(Str::limit($article->excerpt_bn ?? $article->body_bn, 160)))

@php
    $comments = $article->comments()->whereNull('parent_id')->with(['user', 'replies.user'])->latest()->get();
    $shareUrl = urlencode(url()->current());
    $shareTitle = urlencode($article->title_bn);
@endphp

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="lg:grid lg:grid-cols-12 lg:gap-8">
        {{-- Sticky Share Sidebar --}}
        <aside class="hidden lg:block lg:col-span-1">
            <div class="sticky top-24 flex flex-col items-center gap-3">
                <span class="text-[9px] font-bold uppercase tracking-widest text-[#999] dark:text-[#777] [writing-mode:vertical-lr] mb-2">শেয়ার</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" class="w-9 h-9 bg-[#0d0d0d] dark:bg-[#333] text-white hover:bg-[#E02020] dark:hover:bg-[#E02020] flex items-center justify-center transition-colors rounded-full" title="ফেসবুকে শেয়ার">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.35 3.24 9.35 5.47v1.99H7v3.52h2.35V23h5.15V11.01h3.49l.78-3.55z"/></svg>
                </a>
                <a href="https://twitter.com/intent/tweet?text={{ $shareTitle }}&url={{ $shareUrl }}" target="_blank" class="w-9 h-9 bg-[#0d0d0d] dark:bg-[#333] text-white hover:bg-[#E02020] dark:hover:bg-[#E02020] flex items-center justify-center transition-colors rounded-full" title="টুইটারে শেয়ার">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.38.1-.77.16-1.18.16-.3 0-.58-.03-.86-.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.47c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/></svg>
                </a>
                <a href="https://wa.me/?text={{ $shareUrl }}" target="_blank" class="w-9 h-9 bg-[#0d0d0d] dark:bg-[#333] text-white hover:bg-[#E02020] dark:hover:bg-[#E02020] flex items-center justify-center transition-colors rounded-full" title="হোয়াটসঅ্যাপে শেয়ার">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.1 3.9C17.9 1.7 15 .5 12 .5 5.8.5.7 5.6.7 11.9c0 2 .5 3.9 1.5 5.6L.6 23.4l6-1.6c1.6.9 3.5 1.3 5.4 1.3 6.3 0 11.4-5.1 11.4-11.4-.1-2.8-1.2-5.7-3.3-7.8zM12 21.4c-1.7 0-3.3-.5-4.8-1.3l-.4-.2-3.5 1 .9-3.4-.2-.4c-.8-1.3-1.3-2.9-1.3-4.5 0-5.2 4.2-9.4 9.4-9.4 2.5 0 4.9 1 6.7 2.8 1.8 1.8 2.8 4.2 2.8 6.7-.1 5.2-4.3 9.4-9.5 9.4zm5.1-7.1c-.3-.1-1.7-.9-1.9-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1s-1.2-.5-2.3-1.4c-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6s.3-.3.4-.5c.2-.1.3-.3.4-.5.1-.2 0-.4 0-.5-.1-.1-.7-1.7-1-2.3-.3-.6-.6-.5-.8-.6-.2-.1-.4-.1-.6-.1s-.5.1-.8.4c-.3.3-1 1-1 2.4s1 2.8 1.1 2.9c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.3-.3-.4-.6-.5z"/></svg>
                </a>
                <button onclick="navigator.clipboard.writeText(window.location.href);alert('লিংক কপি হয়েছে!')" class="w-9 h-9 bg-[#0d0d0d] dark:bg-[#333] text-white hover:bg-[#E02020] dark:hover:bg-[#E02020] flex items-center justify-center transition-colors rounded-full" title="লিংক কপি">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </button>
            </div>
        </aside>

        {{-- Article Main --}}
        <article class="lg:col-span-8 xl:col-span-7">
            {{-- Breadcrumb --}}
            <nav class="text-xs text-[#999] dark:text-[#777] mb-4 flex items-center gap-2" aria-label="Breadcrumb">
                <a href="/" class="hover:text-[#0d0d0d] dark:hover:text-white transition">হোম</a>
                <span>/</span>
                @if($article->category)
                <a href="{{ route('article.category', $article->category->slug) }}" class="hover:text-[#0d0d0d] dark:hover:text-white transition">{{ $article->category->name_bn }}</a>
                @endif
            </nav>

            {{-- Category --}}
            @if($article->category)
            <span class="text-[9px] font-bold uppercase tracking-widest text-[#E02020]">{{ $article->category->name_bn }}</span>
            @endif

            {{-- Headline --}}
            <h1 class="font-['Playfair_Display'] text-3xl lg:text-4xl font-bold leading-tight mt-2 mb-3">{{ $article->title_bn }}</h1>

            {{-- Excerpt --}}
            @if($article->excerpt_bn)
            <p class="text-lg text-[#666] dark:text-[#999] leading-relaxed mb-4">{{ $article->excerpt_bn }}</p>
            @endif

            {{-- Byline & Meta --}}
            <div class="flex flex-wrap items-center gap-3 text-sm text-[#999] dark:text-[#777] mb-6 pb-5 border-b border-[#e0e0e0] dark:border-[#333]">
                @if($article->staffs->isNotEmpty())
                <span class="font-semibold text-[#1a1a1a] dark:text-white">
                    @foreach($article->staffs as $i => $s)@if($i>0), @endif<a href="{{ route('staff.articles', $s) }}" class="hover:text-[#E02020] transition">{{ $s->name_bn }}</a>@endforeach
                </span>
                @if($article->staffs->first()->designation_bn)
                <span class="text-xs">{{ $article->staffs->first()->designation_bn }}</span>
                @endif
                <span aria-hidden="true">•</span>
                @elseif($article->author)
                <span class="font-semibold text-[#1a1a1a] dark:text-white">{{ $article->author->name }}</span>
                <span aria-hidden="true">•</span>
                @endif
                <time datetime="{{ $article->published_at?->toIso8601String() }}">{{ $article->published_at?->format('d F Y, h:i A') }}</time>
                @if($article->reading_time_minutes)
                <span aria-hidden="true">•</span>
                <span>{{ $article->reading_time_minutes }} মিনিট পড়া</span>
                @endif
            </div>

            {{-- Featured Image / Video --}}
            @if($article->has_video)
            <figure class="mb-6">
                <div class="aspect-[16/9] bg-[#0d0d0d] dark:bg-[#1a1a1a] overflow-hidden">
                    <iframe src="{{ $article->youTubeEmbed }}?autoplay=0&rel=0" title="{{ $article->title_bn }}"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        class="w-full h-full"></iframe>
                </div>
                @if($article->featured_image_caption)
                <figcaption class="text-xs text-[#999] dark:text-[#777] mt-2">{{ $article->featured_image_caption }}</figcaption>
                @endif
            </figure>
            @elseif($article->featured_image)
            <figure class="mb-6">
                <div class="aspect-[16/9] bg-[#0d0d0d] dark:bg-[#1a1a1a] overflow-hidden">
                    <img src="{{ $article->featured_image }}" alt="{{ $article->title_bn }}" class="w-full h-full object-cover">
                </div>
                @if($article->featured_image_caption)
                <figcaption class="text-xs text-[#999] dark:text-[#777] mt-2">{{ $article->featured_image_caption }}
                    @if($article->photo_credit)
                    <span class="italic">ছবি: {{ $article->photo_credit }}</span>
                    @endif
                </figcaption>
                @endif
            </figure>
            @endif

            @include('partials.ads.article-top')

            {{-- Body --}}
            <div class="article-body">
                {!! $article->body_bn !!}
            </div>

            @include('partials.ads.article-bottom')

            {{-- Tags --}}
            @if($article->tags->isNotEmpty())
            <div class="flex flex-wrap gap-2 mt-8 pt-5 border-t border-[#e0e0e0] dark:border-[#333]">
                @foreach($article->tags as $tag)
                <span class="text-xs bg-[#f5f5f5] dark:bg-[#2a2a2a] text-[#666] dark:text-[#aaa] px-3 py-1.5 leading-none">{{ $tag->tag }}</span>
                @endforeach
            </div>
            @endif

            {{-- Mobile Share --}}
            <div class="flex items-center gap-2 mt-8 pt-5 border-t border-[#e0e0e0] dark:border-[#333] lg:hidden no-print">
                <span class="text-[9px] font-bold uppercase tracking-widest text-[#999] dark:text-[#777] mr-1">শেয়ার</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" class="bg-[#0d0d0d] dark:bg-[#333] text-white px-3 py-2 text-xs font-medium hover:opacity-80 transition">ফেসবুক</a>
                <a href="https://wa.me/?text={{ $shareUrl }}" target="_blank" class="bg-[#0d0d0d] dark:bg-[#333] text-white px-3 py-2 text-xs font-medium hover:opacity-80 transition">হোয়াটসঅ্যাপ</a>
                <button onclick="navigator.clipboard.writeText(window.location.href);alert('লিংক কপি হয়েছে!')" class="bg-[#0d0d0d] dark:bg-[#333] text-white px-3 py-2 text-xs font-medium hover:opacity-80 transition">লিংক কপি</button>
                <button onclick="window.print()" class="text-xs text-[#666] dark:text-[#999] hover:text-[#0d0d0d] dark:hover:text-white transition ml-auto">প্রিন্ট</button>
            </div>
        </article>

        {{-- Right Sidebar (empty for article pages — ads go here) --}}
        <aside class="hidden xl:block xl:col-span-1"></aside>
    </div>
</div>

{{-- Comments Section --}}
<section class="max-w-7xl mx-auto px-4 mt-12 no-print" id="comments">
    <div class="lg:grid lg:grid-cols-12 lg:gap-8">
        <div class="lg:col-span-8 xl:col-span-7 lg:col-start-2">
            <div class="section-rule">
                <h2 class="section-label">মন্তব্য</h2>

                @auth
                <form method="POST" action="{{ route('comments.store') }}" class="mb-8">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <textarea name="body" rows="3" required placeholder="আপনার মন্তব্য লিখুন..."
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-3 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888]"></textarea>
                    <button type="submit" class="mt-3 bg-[#0d0d0d] dark:bg-[#333] text-white px-6 py-2.5 text-sm font-medium hover:bg-black/80 dark:hover:bg-[#444] transition">
                        মন্তব্য করুন
                    </button>
                </form>
                @else
                <div class="bg-[#f5f5f5] dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-5 text-center mb-8">
                    <p class="text-sm text-[#666] dark:text-[#999]">মন্তব্য করতে <a href="{{ route('login') }}" class="text-[#E02020] hover:underline font-medium">লগইন</a> করুন।</p>
                </div>
                @endif

                <div class="space-y-0">
                    @forelse($comments as $comment)
                    <div class="py-5 {{ !$loop->last ? 'border-b border-[#e0e0e0] dark:border-[#333]' : '' }}">
                        <div class="flex items-center gap-3 mb-1.5">
                            <div class="w-8 h-8 bg-[#0d0d0d] dark:bg-[#333] text-white text-xs font-bold flex items-center justify-center rounded-full shrink-0">
                                {{ strtoupper(substr($comment->user?->name ?? '?', 0, 1)) }}
                            </div>
                            <div>
                                <span class="text-sm font-semibold">{{ $comment->user?->name }}</span>
                                <span class="text-xs text-[#999] dark:text-[#777] ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <p class="text-sm leading-relaxed text-[#333] dark:text-[#ccc] pl-11">{{ $comment->body }}</p>
                    </div>
                    @empty
                    <p class="text-sm text-[#999] dark:text-[#777] py-5">এখনো কোনো মন্তব্য নেই। প্রথম মন্তব্য করুন!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Related Articles --}}
@if($related->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 mt-12 mb-8 section-rule no-print">
    <h2 class="section-label">সংশ্লিষ্ট সংবাদ</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($related as $story)
        <a href="{{ route('article.show', $story->slug) }}" class="group">
            <div class="aspect-[16/9] bg-[#0d0d0d] dark:bg-[#1a1a1a] overflow-hidden relative mb-3">
                @if($story->has_video)
                @include('partials.youtube-embed', ['videoUrl' => $story->video_url, 'mode' => 'thumb'])
                @elseif($story->featured_image)
                <img src="{{ $story->featured_image }}" alt="" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                @endif
            </div>
            <h3 class="font-['Playfair_Display'] text-lg font-bold leading-snug group-hover:text-[#E02020] transition-colors">
                {{ $story->title_bn }}
            </h3>
            <p class="text-xs text-[#999] dark:text-[#777] mt-1">{{ $story->published_at?->diffForHumans() }}</p>
        </a>
        @endforeach
    </div>
</section>
@endif
@endsection
