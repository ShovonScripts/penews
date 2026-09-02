@extends('layouts.app')

@section('title', config('app.name') . ' — প্রাথমিক শিক্ষা নিউজ')

@section('content')
{{-- Breaking News Ticker --}}
@if($breakingStories->isNotEmpty())
<div class="bg-[#E02020] text-white text-sm">
    <div class="max-w-7xl mx-auto px-4 flex items-center h-9 gap-3">
        <span class="shrink-0 text-[10px] md:text-xs font-bold uppercase tracking-widest bg-white/20 px-2 py-0.5 breaking-pulse" style="border-radius:2px">ব্রেকিং</span>
        <div class="overflow-hidden flex-1 relative">
            <div class="flex gap-12 ticker-track whitespace-nowrap">
                @foreach($breakingStories as $story)
                <a href="{{ route('article.show', $story->slug) }}" class="text-white/90 hover:text-white transition shrink-0 text-sm">{{ $story->title_bn }}</a>
                @endforeach
                @foreach($breakingStories as $story)
                <a href="{{ route('article.show', $story->slug) }}" class="text-white/90 hover:text-white transition shrink-0 text-sm">{{ $story->title_bn }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<div class="max-w-7xl mx-auto px-4 py-3">

    {{-- Slider Carousel --}}
    @if($sliderArticles->isNotEmpty())
    <div class="relative mb-4 bg-[#0d0d0d] dark:bg-[#1a1a1a] overflow-hidden" id="sliderCarousel">
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-white/10 z-10" id="sliderProgressTrack">
            <div class="h-full bg-[#E02020] transition-all duration-300" id="sliderProgressBar" style="width:0%"></div>
        </div>
        <div class="flex transition-transform duration-500 ease-in-out" id="sliderTrack">
            @foreach($sliderArticles as $index => $slide)
            <a href="{{ route('article.show', $slide->slug) }}" class="group w-full shrink-0 relative">
                <div class="aspect-[21/9] md:aspect-[3/1] bg-[#0d0d0d] overflow-hidden">
                    @if($slide->has_video)
                    @include('partials.youtube-embed', ['videoUrl' => $slide->video_url, 'mode' => 'thumb'])
                    @elseif($slide->featured_image)
                    <img src="{{ $slide->featured_image }}" alt="" loading="lazy" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-white/10">
                        <svg class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-3 md:p-6">
                    @if($slide->category)
                    <span class="text-[10px] md:text-xs font-bold uppercase tracking-widest text-[#E02020] bg-white/10 px-2 py-0.5 inline-block mb-1.5">{{ $slide->category->name_bn }}</span>
                    @endif
                    <h2 class="font-serif text-base md:text-xl lg:text-2xl font-bold text-white leading-tight group-hover:text-[#E02020] transition-colors">{{ $slide->title_bn }}</h2>
                    <p class="text-white/60 text-xs md:text-sm mt-1.5 max-w-2xl hidden md:block">{{ Str::limit($slide->excerpt_bn ?? strip_tags($slide->body_bn), 120) }}</p>
                </div>
            </a>
            @endforeach
        </div>

        <div class="absolute bottom-2 md:bottom-4 right-4 md:right-8 flex items-center gap-2 z-10">
            @foreach($sliderArticles as $index => $slide)
            <button type="button" onclick="goToSlide({{ $index }})" class="w-2 h-2 md:w-3 md:h-3 rounded-full transition-all duration-300 slider-dot {{ $index === 0 ? 'bg-[#E02020] w-4 md:w-6' : 'bg-white/50 hover:bg-white/80' }}" data-index="{{ $index }}" aria-label="Go to Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <button type="button" onclick="prevSlide()" class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 z-10 w-8 h-8 md:w-10 md:h-10 bg-black/40 hover:bg-[#E02020] text-white flex items-center justify-center transition-colors rounded-full" aria-label="Previous Slide">
            <svg class="h-4 w-4 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button type="button" onclick="nextSlide()" class="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 z-10 w-8 h-8 md:w-10 md:h-10 bg-black/40 hover:bg-[#E02020] text-white flex items-center justify-center transition-colors rounded-full" aria-label="Next Slide">
            <svg class="h-4 w-4 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>

    <script>
    (function() {
        var carousel = document.getElementById('sliderCarousel');
        var track = document.getElementById('sliderTrack');
        var progressBar = document.getElementById('sliderProgressBar');
        if (!track || !carousel) return;
        var total = {{ $sliderArticles->count() }};
        var current = 0;
        var interval = 5000;
        var autoplay;
        var progressStart;
        var touchStartX = 0;

        function goToSlide(index) {
            current = index;
            track.style.transform = 'translateX(-' + (current * 100) + '%)';
            document.querySelectorAll('.slider-dot').forEach(function(dot, i) {
                dot.className = 'w-2 h-2 md:w-3 md:h-3 rounded-full transition-all duration-300 slider-dot ' + (i === current ? 'bg-[#E02020] w-4 md:w-6' : 'bg-white/50 hover:bg-white/80');
            });
            resetAutoplay();
        }

        function nextSlide() {
            goToSlide((current + 1) % total);
        }

        function prevSlide() {
            goToSlide((current - 1 + total) % total);
        }

        function resetAutoplay() {
            clearInterval(autoplay);
            if (progressBar) { progressBar.style.transition = 'none'; progressBar.style.width = '0%'; }
            progressStart = Date.now();
            autoplay = setInterval(tick, 50);
        }

        function tick() {
            var elapsed = Date.now() - progressStart;
            var pct = Math.min((elapsed / interval) * 100, 100);
            if (progressBar) { progressBar.style.transition = 'none'; progressBar.style.width = pct + '%'; }
            if (pct >= 100) nextSlide();
        }

        window.goToSlide = goToSlide;
        window.nextSlide = nextSlide;
        window.prevSlide = prevSlide;

        resetAutoplay();

        carousel.addEventListener('mouseenter', function() { clearInterval(autoplay); });
        carousel.addEventListener('mouseleave', function() { resetAutoplay(); });

        carousel.addEventListener('touchstart', function(e) { touchStartX = e.changedTouches[0].screenX; }, {passive:true});
        carousel.addEventListener('touchend', function(e) {
            var diff = touchStartX - e.changedTouches[0].screenX;
            if (Math.abs(diff) > 50) {
                diff > 0 ? nextSlide() : prevSlide();
            }
        }, {passive:true});

        document.addEventListener('keydown', function(e) {
            if (!document.contains(carousel)) return;
            if (e.key === 'ArrowLeft') prevSlide();
            if (e.key === 'ArrowRight') nextSlide();
        });
    })();
    </script>
    @endif

    {{-- Single 8/4 Grid: Left column (lead story + category sections) + Right sidebar --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        {{-- Left Column (8 cols): Lead Story + Category Sections --}}
        <div class="lg:col-span-8 space-y-4">
            {{-- Lead Story --}}
            @if($leadStory)
            <a href="{{ route('article.show', $leadStory->slug) }}" class="group block bg-[#0d0d0d] dark:bg-[#1a1a1a] border border-[#e0e0e0] dark:border-[#333] shadow-sm hover:shadow-md transition-all duration-300 hover-scale reveal stagger-1 relative">
                <button type="button" class="btn-save" title="সংরক্ষণ করুন" aria-label="Save Article" onclick="event.preventDefault(); alert('Article saved!')">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                </button>
                <div class="relative aspect-[16/9] md:aspect-[21/9] bg-[#0d0d0d] overflow-hidden img-skeleton">
                    @if($leadStory->has_video)
                    @include('partials.youtube-embed', ['videoUrl' => $leadStory->video_url, 'mode' => 'thumb'])
                    @elseif($leadStory->featured_image)
                    <img src="{{ $leadStory->featured_image }}" alt="" loading="lazy" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-3 md:p-5">
                        @if($leadStory->category)
                        <span class="text-[10px] md:text-xs font-bold uppercase tracking-widest text-[#E02020] bg-white/10 px-2 py-0.5 inline-block mb-1.5">{{ $leadStory->category->name_bn }}</span>
                        @endif
                        <h1 class="font-serif text-lg md:text-xl lg:text-2xl xl:text-3xl font-bold leading-tight text-white group-hover:text-[#E02020] transition-colors">{{ $leadStory->title_bn }}</h1>
                        <p class="text-white/70 text-sm mt-1.5 max-w-2xl leading-relaxed hidden md:block">{{ Str::limit($leadStory->excerpt_bn ?? strip_tags($leadStory->body_bn), 150) }}</p>
                    </div>
                    @if($leadStory->is_breaking)
                    <span class="absolute top-3 left-3 bg-[#E02020] text-white text-xs font-bold uppercase px-2 py-0.5 tracking-wider z-10">ব্রেকিং</span>
                    @endif
                </div>
                @if(!$leadStory->has_video && !$leadStory->featured_image)
                <div class="p-4 @if($leadStory->is_breaking) pt-4 @endif">
                    @if($leadStory->is_breaking)
                    <span class="bg-[#E02020] text-white text-xs font-bold uppercase px-2 py-0.5 tracking-wider inline-block mb-1.5">ব্রেকিং</span>
                    @endif
                    @if($leadStory->category)
                    <span class="text-xs font-bold uppercase tracking-widest text-[#E02020]">{{ $leadStory->category->name_bn }}</span>
                    @endif
                    <h1 class="font-serif text-xl lg:text-2xl xl:text-3xl font-bold leading-tight mt-1 text-white group-hover:text-[#E02020] transition-colors">{{ $leadStory->title_bn }}</h1>
                    <p class="text-white/60 text-sm mt-1.5 leading-relaxed">{{ Str::limit($leadStory->excerpt_bn ?? strip_tags($leadStory->body_bn), 180) }}</p>
                </div>
                @endif
                <div class="px-4 md:px-6 py-2.5 bg-[#0d0d0d] border-t border-white/10 flex flex-wrap items-center gap-3 text-xs text-white/50">
                    @if($leadStory->staffs->isNotEmpty())
                    <span>@foreach($leadStory->staffs as $i => $s)@if($i>0), @endif<a href="{{ route('staff.articles', $s) }}" class="hover:text-[#E02020] transition font-semibold text-white/70">{{ $s->name_bn }}</a>@endforeach</span>
                    <span aria-hidden="true">•</span>
                    @endif
                    <span>{{ $leadStory->published_at?->format('d F Y') }}</span>
                    @if($leadStory->reading_time_minutes)<span aria-hidden="true">•</span><span>{{ $leadStory->reading_time_minutes }} মিনিট পড়া</span>@endif
                    <span class="ml-auto inline-flex items-center gap-1 text-xs font-bold text-[#E02020] group-hover:underline">
                        বিস্তারিত
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </a>
            @endif

            {{-- Category Sections --}}
            @foreach($categories as $category)
            @if($category->articles->isNotEmpty())
            @php $arts = $category->articles; $featured = $arts->shift(); $sub = $arts->take(2); $more = $arts->slice(2); @endphp
            <div>
                <div class="flex items-baseline justify-between mb-2 border-b border-[#e0e0e0] dark:border-[#333] pb-1">
                    <h2 class="text-sm md:text-base font-bold text-[#1a1a1a] dark:text-white">
                        <a href="{{ route('article.category', $category->slug) }}" class="hover:text-[#E02020] transition-colors">{{ $category->name_bn }}</a>
                    </h2>
                    <a href="{{ route('article.category', $category->slug) }}" class="text-xs md:text-sm font-bold uppercase tracking-widest text-[#E02020] hover:underline shrink-0">সবগুলো দেখুন</a>
                </div>

                <div class="space-y-3">
                    @if($featured || $sub->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        @if($featured)
                        <div class="md:col-span-2">
                            <a href="{{ route('article.show', $featured->slug) }}" class="group block h-full bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] shadow-sm hover:shadow-md transition-all duration-300 hover-scale reveal stagger-2 relative">
                                <button type="button" class="btn-save" title="সংরক্ষণ করুন" aria-label="Save Article" onclick="event.preventDefault(); alert('Article saved!')">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                                </button>
                                @if($featured->has_video || $featured->featured_image)
                                <div class="aspect-[16/9] bg-[#0d0d0d] dark:bg-[#1a1a1a] overflow-hidden relative img-skeleton">
                                    @if($featured->has_video)
                                    @include('partials.youtube-embed', ['videoUrl' => $featured->video_url, 'mode' => 'thumb'])
                                    @else
                                    <img src="{{ $featured->featured_image }}" alt="" loading="lazy" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                                    @endif
                                </div>
                                @endif
                                <div class="p-3">
                                    @if($featured->is_editor_pick)
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#E02020] border border-[#E02020] px-1.5 py-0.5 inline-block w-fit mb-1">এডিটরস পিক</span>
                                    @endif
                                    <h3 class="text-[15px] md:text-base font-bold leading-snug group-hover:text-[#E02020] transition-colors">{{ $featured->title_bn }}</h3>
                                    <p class="text-xs text-[#666] dark:text-[#999] mt-1 leading-relaxed line-clamp-2">{{ Str::limit($featured->excerpt_bn ?? strip_tags($featured->body_bn), 100) }}</p>
                                </div>
                            </a>
                        </div>
                        @endif

                        @if($sub->isNotEmpty())
                        <div class="flex flex-col gap-3">
                            @foreach($sub as $story)
                            <a href="{{ route('article.show', $story->slug) }}" class="group block bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] shadow-sm hover:shadow-md transition-all duration-300 hover-scale reveal stagger-3 p-3 relative">
                                <button type="button" class="btn-save" title="সংরক্ষণ করুন" aria-label="Save Article" onclick="event.preventDefault(); alert('Article saved!')">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                                </button>
                                @if($story->is_editor_pick)
                                <span class="text-[10px] font-bold uppercase tracking-widest text-[#E02020] border border-[#E02020] px-1 py-0.5 inline-block w-fit mb-1">এডিটরস পিক</span>
                                @endif
                                <h3 class="text-sm font-bold leading-snug group-hover:text-[#E02020] transition-colors">{{ $story->title_bn }}</h3>
                                <p class="text-xs text-[#666] dark:text-[#999] mt-1 leading-relaxed line-clamp-2">{{ Str::limit($story->excerpt_bn ?? strip_tags($story->body_bn), 80) }}</p>
                            </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endif

                    @if($more->isNotEmpty())
                    <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] divide-y divide-[#e0e0e0] dark:divide-[#333]">
                        @foreach($more as $story)
                        <a href="{{ route('article.show', $story->slug) }}" class="group flex items-center gap-2 px-3 py-2 hover:bg-[#f5f5f5] dark:hover:bg-[#2a2a2a] transition-colors relative hover-scale reveal stagger-3">
                            <button type="button" class="btn-save !right-2 !top-1 !w-6 !h-6" title="সংরক্ষণ করুন" aria-label="Save Article" onclick="event.preventDefault(); alert('Article saved!')">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                            </button>
                            <span class="w-1 h-1 rounded-full bg-[#E02020] shrink-0"></span>
                            <p class="text-[13px] font-medium leading-snug group-hover:text-[#E02020] transition-colors line-clamp-1">{{ $story->title_bn }}</p>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endif
            @endforeach
        </div>

        {{-- Right Sidebar (4 cols) --}}
        <aside class="lg:col-span-4 space-y-4">
            {{-- Featured Stories --}}
            @if($featuredStories->isNotEmpty())
            <div class="flex flex-col gap-3">
                @foreach($featuredStories as $story)
                <a href="{{ route('article.show', $story->slug) }}" class="group flex gap-2.5 bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] shadow-sm hover:shadow-md transition-all duration-300 hover-scale reveal stagger-2 p-2.5 relative">
                    <button type="button" class="btn-save" title="সংরক্ষণ করুন" aria-label="Save Article" onclick="event.preventDefault(); alert('Article saved!')">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                    </button>
                    @if($story->has_video || $story->featured_image)
                    <div class="w-[100px] shrink-0 aspect-[4/3] bg-[#0d0d0d] dark:bg-[#1a1a1a] overflow-hidden relative img-skeleton">
                        @if($story->has_video)
                        @include('partials.youtube-embed', ['videoUrl' => $story->video_url, 'mode' => 'thumb'])
                        @else
                        <img src="{{ $story->featured_image }}" alt="" loading="lazy" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        @endif
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        @if($story->category)
                        <span class="text-xs font-bold uppercase tracking-widest text-[#E02020]">{{ $story->category->name_bn }}</span>
                        @endif
                        <h2 class="text-sm font-bold leading-snug mt-0.5 group-hover:text-[#E02020] transition-colors line-clamp-3">{{ $story->title_bn }}</h2>
                        <p class="text-xs text-[#999] dark:text-[#777] mt-1">{{ $story->published_at?->format('d F Y') }}</p>
                    </div>
                </a>
                @endforeach
            </div>
            @endif

            {{-- Editor's Pick --}}
            @if($editorPicks->isNotEmpty())
            <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-3">
                <h3 class="text-[10px] font-bold uppercase tracking-widest text-[#E02020] mb-2 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#E02020]"></span>
                    এডিটরস পিক
                </h3>
                <div class="space-y-2">
                    @foreach($editorPicks as $story)
                    <a href="{{ route('article.show', $story->slug) }}" class="group flex gap-2 {{ !$loop->first ? 'pt-2 border-t border-[#e0e0e0] dark:border-[#333]' : '' }}">
                        @if($story->has_video || $story->featured_image)
                        <div class="w-14 shrink-0 aspect-square bg-[#0d0d0d] dark:bg-[#1a1a1a] overflow-hidden relative">
                            @if($story->has_video)
                            @include('partials.youtube-embed', ['videoUrl' => $story->video_url, 'mode' => 'thumb'])
                            @else
                            <img src="{{ $story->featured_image }}" alt="" loading="lazy" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                            @endif
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold leading-snug group-hover:text-[#E02020] dark:group-hover:text-[#ff6b6b] transition-colors line-clamp-2">{{ $story->title_bn }}</p>
                            <p class="text-xs text-[#999] dark:text-[#777] mt-1">{{ $story->published_at?->format('d F Y') }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Most Read --}}
            <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-3">
                <h3 class="text-[10px] font-bold uppercase tracking-widest text-[#999] dark:text-[#777] mb-2">সর্বাধিক পঠিত</h3>
                <div class="space-y-2">
                    @foreach($mostRead as $index => $story)
                    <a href="{{ route('article.show', $story->slug) }}" class="group flex gap-2 {{ $index > 0 ? 'pt-2 border-t border-[#e0e0e0] dark:border-[#333]' : '' }}">
                        <span class="font-serif text-lg font-bold text-[#ccc] dark:text-[#555] leading-none shrink-0 w-5">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold leading-snug group-hover:text-[#E02020] dark:group-hover:text-[#ff6b6b] transition-colors">{{ $story->title_bn }}</p>
                            <p class="text-xs text-[#999] dark:text-[#777] mt-1">{{ $story->published_at?->format('d F Y') }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            @include('partials.ads.sidebar')

            {{-- Newsletter --}}
            <div class="bg-[#0d0d0d] dark:bg-[#1a1a1a] border border-[#333] p-3">
                <svg class="h-5 w-5 text-white/40 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <h3 class="text-sm font-bold text-white mb-1">নিউজলেটার</h3>
                <p class="text-xs text-white/50 mb-2">সাপ্তাহিক ডাইজেস্ট পেতে সাবস্ক্রাইব করুন</p>
                <form class="flex gap-1.5" onsubmit="event.preventDefault();var i=this.querySelector('input');if(i.value.trim()){i.value='';alert('সাবস্ক্রিপশন সফল! ধন্যবাদ।')}">
                    <input type="email" placeholder="ইমেইল ঠিকানা" required class="flex-1 px-2.5 py-1.5 text-sm text-[#1a1a1a] dark:text-white bg-white dark:bg-[#2a2a2a] border-0 focus:outline-none focus:ring-2 focus:ring-[#E02020]">
                    <button type="submit" class="bg-[#E02020] text-white px-3 py-1.5 text-sm font-medium hover:bg-red-700 transition shrink-0">সাবস্ক্রাইব</button>
                </form>
            </div>

            {{-- Facebook Page Plugin --}}
            <div class="border border-[#e0e0e0] dark:border-[#333] overflow-hidden">
                <div class="bg-[#1877F2] px-3 py-2 flex items-center gap-2">
                    <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    <span class="text-white text-xs font-bold">PEN News</span>
                </div>
                <iframe
                    src="https://www.facebook.com/plugins/page.php?href={{ urlencode('https://www.facebook.com/penbd/') }}&tabs=timeline&width=340&height=450&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&cta=false"
                    width="340"
                    height="450"
                    style="border:none;overflow:hidden"
                    scrolling="no"
                    frameborder="0"
                    allowfullscreen="true"
                    allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                    class="w-full dark:grayscale dark:contrast-90 dark:brightness-75"
                    loading="lazy"
                    title="PEN News Facebook Timeline"
                ></iframe>
            </div>
            {{-- Facebook Follow CTA --}}
            <a href="{{ $facebookUrl }}" target="_blank" rel="noopener" class="group relative block overflow-hidden rounded-sm text-white transition-all duration-300 hover:shadow-lg hover:shadow-[#1877F2]/20">
                <div class="absolute inset-0 bg-gradient-to-br from-[#1877F2] via-[#1a78f0] to-[#0d65d9]"></div>
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 bg-[radial-gradient(circle_at_30%_50%,rgba(255,255,255,0.12),transparent_60%)]"></div>
                <div class="relative px-4 py-3 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-white/15 flex items-center justify-center shrink-0 group-hover:bg-white/25 transition-colors duration-300">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold leading-tight">Facebook-এ ফলো করুন</p>
                        <p class="text-[11px] text-white/60">সরাসরি আপডেট পান</p>
                    </div>
                    <svg class="h-4 w-4 shrink-0 text-white/50 group-hover:text-white/90 transition-all duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
                </div>
            </a>
        </aside>
    </div>

</div>

<style>
@keyframes ticker {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.ticker-track {
    display: inline-flex;
    animation: ticker 20s linear infinite;
}
.ticker-track:hover { animation-play-state: paused; }
</style>
@endsection
