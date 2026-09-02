<footer class="bg-[#0d0d0d] dark:bg-[#0a0a0a] text-white mt-6 border-t border-[#E02020]/30">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Main Footer --}}
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 py-12 md:py-16">
            {{-- Brand Column --}}
            <div class="md:col-span-4">
                <a href="/" class="font-['Playfair_Display'] font-bold text-3xl tracking-tight text-white">PEN</a>
                <p class="text-white/45 text-sm leading-relaxed mt-4 max-w-xs">
                    প্রাথমিক শিক্ষা নিউজ — বাংলাদেশের প্রাথমিক শিক্ষকদের জন্য বিশ্বস্ত সংবাদ ও সম্পদ।
                </p>
                <div class="flex items-center gap-3 mt-6">
                    @if($socialFacebook)
                    <a href="{{ $socialFacebook }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#E02020] flex items-center justify-center transition-colors" title="ফেসবুক">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.35 3.24 9.35 5.47v1.99H7v3.52h2.35V23h5.15V11.01h3.49l.78-3.55z"/></svg>
                    </a>
                    @endif
                    @if($socialYoutube)
                    <a href="{{ $socialYoutube }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#E02020] flex items-center justify-center transition-colors" title="ইউটিউব">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    @endif
                    @if($socialTwitter)
                    <a href="{{ $socialTwitter }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#E02020] flex items-center justify-center transition-colors" title="টুইটার / এক্স">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    @endif
                    @if($socialInstagram)
                    <a href="{{ $socialInstagram }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#E02020] flex items-center justify-center transition-colors" title="ইনস্টাগ্রাম">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    @endif
                    @if($socialLinkedin)
                    <a href="{{ $socialLinkedin }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#E02020] flex items-center justify-center transition-colors" title="লিংকডইন">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    @endif
                    @if($socialWhatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $socialWhatsapp) }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#E02020] flex items-center justify-center transition-colors" title="হোয়াটসঅ্যাপ">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="md:col-span-2">
                <h4 class="font-semibold text-sm text-white/80 mb-5 uppercase tracking-wider">দ্রুত লিংক</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="/" class="text-white/50 hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#E02020]"></span>প্রথম পাতা</a></li>
                    <li><a href="{{ route('staff.index') }}" class="text-white/50 hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#E02020]"></span>আমাদের টিম</a></li>
                    <li><a href="{{ route('contact.index') }}" class="text-white/50 hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#E02020]"></span>যোগাযোগ</a></li>
                    <li><a href="{{ route('archive.index') }}" class="text-white/50 hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#E02020]"></span>আর্কাইভ</a></li>
                    <li><a href="{{ route('search.index') }}" class="text-white/50 hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#E02020]"></span>অনুসন্ধান</a></li>
                    <li><a href="{{ route('pages.privacy') }}" class="text-white/50 hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#E02020]"></span>প্রাইভেসি পলিসি</a></li>
                    <li><a href="{{ route('pages.terms') }}" class="text-white/50 hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#E02020]"></span>শর্তাবলী</a></li>
                </ul>
            </div>

            {{-- Categories --}}
            <div class="md:col-span-3">
                <h4 class="font-semibold text-sm text-white/80 mb-5 uppercase tracking-wider">বিষয়</h4>
                <ul class="space-y-3 text-sm columns-2">
                    @foreach($footerCategories as $cat)
                    <li><a href="{{ route('article.category', $cat->slug) }}" class="text-white/50 hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#E02020] shrink-0"></span>{{ $cat->name_bn }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div class="md:col-span-3">
                <h4 class="font-semibold text-sm text-white/80 mb-5 uppercase tracking-wider">যোগাযোগ</h4>
                <ul class="space-y-4 text-sm">
                    <li>
                        <a href="mailto:info@primaryeducationnetwork.com" class="text-white/50 hover:text-white transition flex items-start gap-3">
                            <svg class="h-4 w-4 shrink-0 mt-0.5 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>info@primaryeducationnetwork.com</span>
                        </a>
                    </li>
                    <li class="text-white/40 text-xs leading-relaxed flex items-start gap-3">
                        <svg class="h-4 w-4 shrink-0 mt-0.5 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>ঢাকা, বাংলাদেশ</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-white/10 py-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-xs text-white/35">&copy; {{ date('Y') }} <a href="/" class="hover:text-white/60 transition">PEN News</a>. সর্বস্বত্ব সংরক্ষিত।</p>
            <p class="text-xs text-white/35">
                crafted by <a href="https://prodo.top" target="_blank" rel="noopener" class="hover:text-white/60 transition font-semibold">ProDo</a>
            </p>
            <button onclick="window.scrollTo({top:0,behavior:'smooth'})" class="w-8 h-8 rounded-full bg-white/10 hover:bg-[#E02020] flex items-center justify-center transition-colors" title="উপরে যান">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
            </button>
        </div>
    </div>
</footer>
