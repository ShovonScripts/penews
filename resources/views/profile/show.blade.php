@extends('layouts.app')

@section('title', 'প্রোফাইল - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8">
            {{-- Profile Header --}}
            <div class="flex items-center justify-between mb-8 pb-6 border-b border-[#e0e0e0] dark:border-[#333]">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-[#E02020] flex items-center justify-center text-white text-2xl font-bold shrink-0">
                        {{ mb_substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold dark:text-white">{{ $user->name }}</h1>
                        <p class="text-[#666] dark:text-[#999] text-sm">{{ $user->designation ?? 'সদস্য' }}{{ $user->school_name ? ', ' . $user->school_name : '' }}</p>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}"
                    class="border border-[#e0e0e0] dark:border-[#444] text-sm px-4 py-2 hover:bg-gray-50 dark:hover:bg-[#2a2a2a] transition dark:text-[#e0e0e0]">
                    প্রোফাইল সম্পাদনা
                </a>
            </div>

            {{-- Tabs --}}
            <div x-data="{ tab: 'profile' }">
                <div class="flex border-b border-[#e0e0e0] dark:border-[#333] mb-6">
                    <button @click="tab = 'profile'" :class="{ 'border-b-2 border-[#E02020] text-[#E02020] font-semibold': tab === 'profile' }"
                        class="px-5 py-3 text-sm text-[#666] dark:text-[#999] hover:text-[#0d0d0d] dark:hover:text-white transition">
                        প্রোফাইল
                    </button>
                    <button @click="tab = 'comments'" :class="{ 'border-b-2 border-[#E02020] text-[#E02020] font-semibold': tab === 'comments' }"
                        class="px-5 py-3 text-sm text-[#666] dark:text-[#999] hover:text-[#0d0d0d] dark:hover:text-white transition">
                        মন্তব্য
                    </button>
                    <button @click="tab = 'liked'" :class="{ 'border-b-2 border-[#E02020] text-[#E02020] font-semibold': tab === 'liked' }"
                        class="px-5 py-3 text-sm text-[#666] dark:text-[#999] hover:text-[#0d0d0d] dark:hover:text-white transition">
                        পছন্দ করা
                    </button>
                </div>

                {{-- Profile Tab --}}
                <div x-show="tab === 'profile'" x-cloak>
                    <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-6">
                        <h2 class="font-bold text-lg mb-6 border-l-3 border-[#E02020] pl-3 dark:text-white">ব্যক্তিগত তথ্য</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs font-medium text-[#999] dark:text-[#777] uppercase tracking-wider mb-1">ইমেইল</p>
                                <p class="text-sm dark:text-[#e0e0e0]">{{ $user->email }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#999] dark:text-[#777] uppercase tracking-wider mb-1">ফোন</p>
                                <p class="text-sm dark:text-[#e0e0e0]">{{ $user->phone ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#999] dark:text-[#777] uppercase tracking-wider mb-1">দেশ</p>
                                <p class="text-sm dark:text-[#e0e0e0]">{{ $user->country ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#999] dark:text-[#777] uppercase tracking-wider mb-1">জন্মদিন</p>
                                <p class="text-sm dark:text-[#e0e0e0]">{{ $user->birthday ? $user->birthday->format('d F Y') : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#999] dark:text-[#777] uppercase tracking-wider mb-1">লিঙ্গ</p>
                                <p class="text-sm dark:text-[#e0e0e0]">{{ $user->gender ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#999] dark:text-[#777] uppercase tracking-wider mb-1">জেলা</p>
                                <p class="text-sm dark:text-[#e0e0e0]">{{ $user->district?->name_bn ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#999] dark:text-[#777] uppercase tracking-wider mb-1">উপজেলা</p>
                                <p class="text-sm dark:text-[#e0e0e0]">{{ $user->upazila ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#999] dark:text-[#777] uppercase tracking-wider mb-1">বিদ্যালয়</p>
                                <p class="text-sm dark:text-[#e0e0e0]">{{ $user->school_name ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#999] dark:text-[#777] uppercase tracking-wider mb-1">পদবী</p>
                                <p class="text-sm dark:text-[#e0e0e0]">{{ $user->designation ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#999] dark:text-[#777] uppercase tracking-wider mb-1">সদস্য since</p>
                                <p class="text-sm dark:text-[#e0e0e0]">{{ $user->created_at->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Comments Tab --}}
                <div x-show="tab === 'comments'" x-cloak>
                    <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-6">
                        <h2 class="font-bold text-lg mb-6 border-l-3 border-[#E02020] pl-3 dark:text-white">আমার মন্তব্য</h2>
                        @if($comments->isNotEmpty())
                            <div class="space-y-4">
                                @foreach($comments as $comment)
                                <div class="pb-4 border-b border-[#e0e0e0] dark:border-[#333] last:border-0 last:pb-0">
                                    <p class="text-sm dark:text-[#e0e0e0]">{{ Str::limit($comment->body, 200) }}</p>
                                    <div class="flex items-center gap-2 mt-1.5">
                                        <span class="text-xs text-[#999] dark:text-[#777]">{{ $comment->created_at->diffForHumans() }}</span>
                                        <span class="text-[#ccc] dark:text-[#555]">|</span>
                                        <a href="{{ route('article.show', $comment->article?->slug) }}" class="text-xs text-[#E02020] hover:text-red-700 transition">{{ $comment->article?->title_bn ?? '(অপসারিত)' }}</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-6">
                                {{ $comments->links() }}
                            </div>
                        @else
                            <p class="text-sm text-[#999] dark:text-[#777]">কোনো মন্তব্য নেই।</p>
                        @endif
                    </div>
                </div>

                {{-- Liked Posts Tab --}}
                <div x-show="tab === 'liked'" x-cloak>
                    <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-6">
                        <h2 class="font-bold text-lg mb-6 border-l-3 border-[#E02020] pl-3 dark:text-white">পছন্দ করা সংবাদ</h2>
                        @if($likedArticles->isNotEmpty())
                            <div class="space-y-4">
                                @foreach($likedArticles as $article)
                                <div class="flex gap-4 pb-4 border-b border-[#e0e0e0] dark:border-[#333] last:border-0 last:pb-0">
                                    @if($article->featured_image)
                                    <a href="{{ route('article.show', $article->slug) }}" class="shrink-0">
                                        <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title_bn }}" class="w-20 h-16 object-cover">
                                    </a>
                                    @endif
                                    <div class="min-w-0">
                                        <a href="{{ route('article.show', $article->slug) }}" class="text-sm font-semibold hover:text-[#E02020] dark:hover:text-[#ff6b6b] transition-colors line-clamp-2 dark:text-[#e0e0e0]">{{ $article->title_bn }}</a>
                                        <p class="text-xs text-[#999] dark:text-[#777] mt-1">{{ $article->published_at?->diffForHumans() }} | {{ $article->category?->name_bn }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-6">
                                {{ $likedArticles->links() }}
                            </div>
                        @else
                            <p class="text-sm text-[#999] dark:text-[#777]">কোনো পছন্দ করা সংবাদ নেই।</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <aside class="lg:col-span-4 space-y-6">
            {{-- Stats --}}
            <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-5 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-[#666] dark:text-[#999]">মন্তব্য</span>
                    <span class="font-bold text-lg dark:text-white">{{ $user->comments()->count() }}</span>
                </div>
                <div class="flex items-center justify-between border-t border-[#e0e0e0] dark:border-[#333] pt-4">
                    <span class="text-sm text-[#666] dark:text-[#999]">পছন্দ করা</span>
                    <span class="font-bold text-lg dark:text-white">{{ $user->likedArticles()->count() }}</span>
                </div>
                <div class="flex items-center justify-between border-t border-[#e0e0e0] dark:border-[#333] pt-4">
                    <span class="text-sm text-[#666] dark:text-[#999]">সক্রিয় দিন</span>
                    <span class="font-bold text-lg dark:text-white">{{ (int) \Carbon\Carbon::parse($user->created_at)->diffInDays(now()) }}</span>
                </div>
            </div>

            @include('partials.ads.sidebar')
        </aside>
    </div>
</div>
@endsection

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
