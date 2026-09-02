<header class="sticky top-0 z-50">
    {{-- Primary Nav --}}
    <div class="bg-[#0d0d0d] border-b border-[#E02020]">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-14">
            <div class="flex items-center gap-4">
                <button type="button" id="mobileMenuToggle" class="md:hidden text-white/70 hover:text-white transition">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <a href="/" class="flex items-center gap-3">
                    @if($siteLogo)
                        <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteNameBn }}" class="h-9 w-auto">
                    @else
                        <span class="text-white font-['Playfair_Display'] font-bold text-2xl tracking-tight leading-none">PEN</span>
                    @endif
                </a>
                <span class="hidden md:block text-white/70 text-[10px] leading-tight border-l border-white/20 pl-3">
                    {{ $siteNameBn }}
                </span>
            </div>

            <nav class="hidden md:flex items-center gap-1"></nav>

            <div class="flex items-center gap-2">
                <form action="{{ route('search.index') }}" method="GET" class="hidden md:flex items-center gap-1.5" id="navSearchForm">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="অনুসন্ধান..."
                        class="h-8 w-36 lg:w-44 bg-white/10 hover:bg-white/15 focus:bg-white/20 text-white text-xs placeholder-white/40 border border-white/10 focus:border-white/30 focus:outline-none px-3 transition rounded">
                    <button type="submit" class="text-white/60 hover:text-white transition p-1.5" title="অনুসন্ধান">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                </form>
                <button class="text-white/60 hover:text-white transition p-2" title="ডার্ক মোড" id="darkModeToggle">
                    <svg class="h-4 w-4" id="darkModeIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>
                @auth
                    <a href="{{ route('profile.show') }}" class="text-white/70 hover:text-white text-sm transition px-2 py-1" title="প্রোফাইল">
                        <svg class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </a>
                    <a href="{{ route('dashboard') }}" class="text-white/70 hover:text-white text-sm transition px-2 py-1">ড্যাশবোর্ড</a>
                    @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="bg-[#E02020] text-white text-xs font-semibold px-3 py-1.5 hover:bg-red-700 transition">এডমিন</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="bg-[#E02020] text-white px-4 py-1.5 text-sm font-medium hover:bg-red-700 transition">লগইন</a>
                @endauth
            </div>
        </div>
    </div>

    {{-- Topic Nav (Category Bar) --}}
    @if(isset($navCategories) && $navCategories->isNotEmpty())
    <div class="bg-white dark:bg-[#1a1a1a] border-b border-[#e0e0e0] dark:border-[#333] shadow-sm">
        <div class="max-w-7xl mx-auto px-4 flex items-center h-12 overflow-x-auto scrollbar-none">
            <a href="/" class="shrink-0 text-sm font-bold uppercase tracking-wider text-[#E02020] hover:text-red-700 transition px-3 py-2 border-r border-[#e0e0e0] dark:border-[#333]">সব</a>
            <div class="flex items-center gap-0 ml-2">
                @foreach($navCategories as $cat)
                <a href="{{ route('article.category', $cat->slug) }}"
                    class="shrink-0 text-sm font-medium text-[#666] dark:text-[#aaa] hover:text-[#0d0d0d] dark:hover:text-white transition px-3 py-2 whitespace-nowrap @if(request()->routeIs('article.category') && request()->route('slug') === $cat->slug) text-[#E02020] dark:text-[#ff6b6b] font-semibold @endif">
                    {{ $cat->name_bn }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Mobile Menu Overlay --}}
    <div id="mobileMenu" class="fixed inset-0 z-50 hidden md:hidden">
        <div class="absolute inset-0 bg-black/60" id="mobileMenuOverlay"></div>
        <div class="absolute top-0 left-0 w-72 h-full bg-white dark:bg-[#1a1a1a] shadow-xl overflow-y-auto">
            <div class="flex items-center justify-between p-4 border-b border-[#e0e0e0] dark:border-[#333]">
                <a href="/" class="font-['Playfair_Display'] font-bold text-xl text-[#0d0d0d] dark:text-white">PEN</a>
                <button type="button" id="mobileMenuClose" class="text-[#666] dark:text-[#999] hover:text-[#0d0d0d] dark:hover:text-white transition">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <nav class="p-4 space-y-1">
                @if($navCategories->isNotEmpty())
                <div class="pt-4 mt-4 border-t border-[#e0e0e0] dark:border-[#333]">
                    <p class="px-4 text-[10px] font-bold uppercase tracking-wider text-[#999] dark:text-[#777] mb-2">বিষয়</p>
                    @foreach($navCategories as $cat)
                    <a href="{{ route('article.category', $cat->slug) }}"
                        class="block px-4 py-2 text-sm font-medium text-[#666] dark:text-[#aaa] hover:bg-[#f5f5f5] dark:hover:bg-[#2a2a2a] hover:text-[#0d0d0d] dark:hover:text-white rounded transition">
                        {{ $cat->name_bn }}
                    </a>
                    @endforeach
                </div>
                @endif

                @auth
                <div class="pt-4 mt-4 border-t border-[#e0e0e0] dark:border-[#333] space-y-1">
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm font-medium text-[#666] dark:text-[#aaa] hover:bg-[#f5f5f5] dark:hover:bg-[#2a2a2a] hover:text-[#0d0d0d] dark:hover:text-white rounded transition">
                        প্রোফাইল
                    </a>
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm font-medium text-[#666] dark:text-[#aaa] hover:bg-[#f5f5f5] dark:hover:bg-[#2a2a2a] hover:text-[#0d0d0d] dark:hover:text-white rounded transition">
                        ড্যাশবোর্ড
                    </a>
                    @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm font-medium text-[#E02020] hover:bg-[#f5f5f5] dark:hover:bg-[#2a2a2a] rounded transition">
                        এডমিন প্যানেল
                    </a>
                    @endif
                </div>
                @endauth
            </nav>
        </div>
    </div>
</header>

<script>
(function() {
    // Dark mode toggle
    var toggle = document.getElementById('darkModeToggle');
    var icon = document.getElementById('darkModeIcon');
    function updateIcon() {
        if (document.documentElement.classList.contains('dark')) {
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>';
        } else {
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>';
        }
    }
    updateIcon();
    if (toggle) {
        toggle.addEventListener('click', function() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
            updateIcon();
        });
    }

    // Mobile menu
    var openBtn = document.getElementById('mobileMenuToggle');
    var closeBtn = document.getElementById('mobileMenuClose');
    var overlay = document.getElementById('mobileMenuOverlay');
    var menu = document.getElementById('mobileMenu');
    if (openBtn && menu) {
        function openMobile() { menu.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
        function closeMobile() { menu.classList.add('hidden'); document.body.style.overflow = ''; }
        openBtn.addEventListener('click', openMobile);
        if (closeBtn) closeBtn.addEventListener('click', closeMobile);
        if (overlay) overlay.addEventListener('click', closeMobile);
    }
})();
</script>
