@extends('layouts.guest')

@section('title', 'ইমেইল ভেরিফিকেশন - ' . config('app.name'))

@section('content')
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md text-center">
        <div class="bg-white dark:bg-[#1e1e1e] rounded-sm shadow-sm border border-[#e0e0e0] dark:border-[#333] p-8">
            <div class="mb-4">
                <svg class="h-12 w-12 text-green-600 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold mb-4 dark:text-white">আপনার ইমেইল ভেরিফাই করুন</h1>

            @if (session('success'))
                <div class="bg-green-50 dark:bg-green-950/20 border-l-4 border-green-600 p-4 mb-6 text-sm text-green-800 dark:text-green-400 text-left">{{ session('success') }}</div>
            @endif

            <p class="text-[#666] dark:text-[#999] mb-4">
                আপনার ইমেইলে একটি ভেরিফিকেশন লিংক পাঠানো হয়েছে। 
                আপনার একাউন্ট সক্রিয় করতে লিংকে ক্লিক করুন।
            </p>

            <form method="POST" action="{{ route('verification.send') }}" class="mt-4">
                @csrf
                <button type="submit"
                    class="bg-[#E02020] dark:bg-[#cc1a1a] text-white px-6 py-2.5 text-sm font-medium hover:bg-red-700 dark:hover:bg-[#991515] transition">
                    আবার ভেরিফিকেশন ইমেইল পাঠান
                </button>
            </form>

            <p class="text-xs text-[#999] dark:text-[#777] mt-4">
                ভেরিফিকেশন না পেলে স্প্যাম ফোল্ডার চেক করুন।
            </p>
        </div>
    </div>
</div>
@endsection
