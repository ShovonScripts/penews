@extends('layouts.app')
@section('title', 'যোগাযোগ')
@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold font-['Playfair_Display'] dark:text-white">যোগাযোগ</h1>
        <div class="w-12 h-1 bg-[#E02020] mt-3"></div>
        <p class="text-sm text-[#666] dark:text-[#aaa] mt-3 leading-relaxed">
            আপনার মতামত, পরামর্শ বা কোন প্রশ্ন থাকলে নিচের ফর্মটি ব্যবহার করে আমাদের জানাতে পারেন।
        </p>
    </div>

    @if(session('success'))
    <div class="flex items-center gap-2 p-4 mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-sm text-green-700 dark:text-green-400">
        <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
            <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-6 md:p-8">
                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-[#666] dark:text-[#aaa] mb-1.5">আপনার নাম *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-[#e0e0e0] dark:border-[#444] bg-white dark:bg-[#2a2a2a] text-sm px-3 py-2.5 focus:border-[#E02020] dark:focus:border-[#ff6b6b] focus:outline-none dark:text-white">
                            @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-[#666] dark:text-[#aaa] mb-1.5">ইমেইল *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full border border-[#e0e0e0] dark:border-[#444] bg-white dark:bg-[#2a2a2a] text-sm px-3 py-2.5 focus:border-[#E02020] dark:focus:border-[#ff6b6b] focus:outline-none dark:text-white">
                            @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-[#666] dark:text-[#aaa] mb-1.5">ফোন (ঐচ্ছিক)</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-[#e0e0e0] dark:border-[#444] bg-white dark:bg-[#2a2a2a] text-sm px-3 py-2.5 focus:border-[#E02020] dark:focus:border-[#ff6b6b] focus:outline-none dark:text-white">
                            @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-[#666] dark:text-[#aaa] mb-1.5">বিষয় *</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required class="w-full border border-[#e0e0e0] dark:border-[#444] bg-white dark:bg-[#2a2a2a] text-sm px-3 py-2.5 focus:border-[#E02020] dark:focus:border-[#ff6b6b] focus:outline-none dark:text-white">
                            @error('subject') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="mb-5">
                        <label class="block text-xs font-medium text-[#666] dark:text-[#aaa] mb-1.5">বার্তা *</label>
                        <textarea name="message" rows="6" required class="w-full border border-[#e0e0e0] dark:border-[#444] bg-white dark:bg-[#2a2a2a] text-sm px-3 py-2.5 focus:border-[#E02020] dark:focus:border-[#ff6b6b] focus:outline-none dark:text-white resize-y">{{ old('message') }}</textarea>
                        @error('message') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="bg-[#E02020] hover:bg-red-700 text-white text-sm font-medium px-6 py-3 transition">
                        বার্তা পাঠান
                    </button>
                </form>
            </div>
        </div>

        <div>
            <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-6 space-y-6">
                <div>
                    <h3 class="text-sm font-bold dark:text-white mb-3">ইমেইল</h3>
                    <p class="text-sm text-[#666] dark:text-[#aaa]">
                        <a href="mailto:info@primaryeducationnetwork.com" class="hover:text-[#E02020] dark:hover:text-[#ff6b6b] transition">info@primaryeducationnetwork.com</a>
                    </p>
                </div>
                <div>
                    <h3 class="text-sm font-bold dark:text-white mb-3">ঠিকানা</h3>
                    <p class="text-sm text-[#666] dark:text-[#aaa] leading-relaxed">
                        ঢাকা, বাংলাদেশ
                    </p>
                </div>
                <div>
                    <h3 class="text-sm font-bold dark:text-white mb-3">সোশ্যাল</h3>
                    <div class="flex items-center gap-3">
                        <a href="#" class="w-8 h-8 rounded-full bg-[#f5f5f5] dark:bg-[#2a2a2a] hover:bg-[#E02020] dark:hover:bg-[#E02020] flex items-center justify-center transition-colors">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.35 3.24 9.35 5.47v1.99H7v3.52h2.35V23h5.15V11.01h3.49l.78-3.55z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-[#f5f5f5] dark:bg-[#2a2a2a] hover:bg-[#E02020] dark:hover:bg-[#E02020] flex items-center justify-center transition-colors">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
