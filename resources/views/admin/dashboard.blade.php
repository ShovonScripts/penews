@extends('layouts.admin')
@section('title', 'ড্যাশবোর্ড')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold">ড্যাশবোর্ড</h1>
        <p class="text-xs text-[#999] dark:text-[#777] mt-0.5">আজকের ভিজিটর: <strong class="text-[#E02020] dark:text-[#ff6b6b]">{{ number_format($todayViews) }}</strong></p>
    </div>
    <a href="{{ route('admin.articles.create') }}" class="btn-danger flex items-center gap-2">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        নতুন আর্টিকেল
    </a>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3 mb-6">
    <div class="admin-card p-4">
        <p class="text-2xl font-bold font-serif">{{ number_format($stats['articles']) }}</p>
        <p class="text-xs text-[#666] dark:text-[#999] mt-0.5">মোট আর্টিকেল</p>
    </div>
    <div class="admin-card p-4">
        <p class="text-2xl font-bold font-serif text-green-600 dark:text-green-400">{{ number_format($stats['today_published']) }}</p>
        <p class="text-xs text-[#666] dark:text-[#999] mt-0.5">আজ প্রকাশিত</p>
    </div>
    <div class="admin-card p-4">
        <p class="text-2xl font-bold font-serif text-yellow-600 dark:text-yellow-400">{{ number_format($stats['drafts']) }}</p>
        <p class="text-xs text-[#666] dark:text-[#999] mt-0.5">খসড়া</p>
    </div>
    <div class="admin-card p-4">
        <p class="text-2xl font-bold font-serif text-blue-600 dark:text-blue-400">{{ number_format($stats['scheduled']) }}</p>
        <p class="text-xs text-[#666] dark:text-[#999] mt-0.5">নির্ধারিত</p>
    </div>
    <div class="admin-card p-4">
        <p class="text-2xl font-bold font-serif text-red-600 dark:text-red-400">{{ number_format($stats['breaking']) }}</p>
        <p class="text-xs text-[#666] dark:text-[#999] mt-0.5">ব্রেকিং</p>
    </div>
    <div class="admin-card p-4">
        <p class="text-2xl font-bold font-serif">{{ number_format($stats['users']) }}</p>
        <p class="text-xs text-[#666] dark:text-[#999] mt-0.5">ব্যবহারকারী</p>
    </div>
    <div class="admin-card p-4">
        <p class="text-2xl font-bold font-serif">{{ number_format($stats['comments']) }}</p>
        <p class="text-xs text-[#666] dark:text-[#999] mt-0.5">মন্তব্য</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 admin-card">
        <div class="flex items-center justify-between px-5 py-3 border-b border-[#e0e0e0] dark:border-[#333]">
            <h2 class="text-sm font-bold">সর্বশেষ আর্টিকেল</h2>
            <a href="{{ route('admin.articles.index') }}" class="text-xs text-[#999] dark:text-[#777] hover:text-[#0d0d0d] dark:hover:text-white transition">সব দেখুন →</a>
        </div>
        <div class="divide-y divide-[#e0e0e0] dark:divide-[#333]">
            @foreach($recentArticles as $article)
            <div class="flex items-center justify-between px-5 py-3 admin-hover-row text-sm">
                <div class="flex items-center gap-3 min-w-0 flex-1">
                    @if($article->is_breaking)<span class="breaking-badge shrink-0">ব্রেকিং</span>@endif
                    @if($article->is_featured)<span class="badge-flag bg-yellow-500 text-white shrink-0">ফিচারড</span>@endif
                    <span class="truncate">{{ Str::limit($article->title_bn, 55) }}</span>
                </div>
                <div class="flex items-center gap-3 shrink-0 ml-3">
                    <span class="text-xs px-1.5 py-0.5 {{ match($article->status) { 'published' => 'badge-published', 'scheduled' => 'badge-scheduled', default => 'badge-draft' } }}">
                        {{ $article->status === 'published' ? 'প্রকাশিত' : ($article->status === 'scheduled' ? 'নির্ধারিত' : 'খসড়া') }}
                    </span>
                    <span class="text-xs text-[#999] dark:text-[#777]">{{ $article->created_at->format('d/m') }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Right Column --}}
    <div class="space-y-6">
        <div class="admin-card p-5">
            <h2 class="text-sm font-bold mb-3 flex items-center gap-2">
                <svg class="h-4 w-4 text-[#666] dark:text-[#999]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                আজকের পরিসংখ্যান
            </h2>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between border-b border-[#e0e0e0] dark:border-[#333] pb-1.5"><span class="text-[#666] dark:text-[#999]">প্রকাশিত</span><span class="font-semibold">{{ $stats['today_published'] }}</span></div>
                <div class="flex justify-between border-b border-[#e0e0e0] dark:border-[#333] pb-1.5"><span class="text-[#666] dark:text-[#999]">ভিজিটর</span><span class="font-semibold">{{ number_format($todayViews) }}</span></div>
                <div class="flex justify-between border-b border-[#e0e0e0] dark:border-[#333] pb-1.5"><span class="text-[#666] dark:text-[#999]">ব্রেকিং নিউজ</span><span class="font-semibold">{{ $stats['breaking'] }}</span></div>
                <div class="flex justify-between border-b border-[#e0e0e0] dark:border-[#333] pb-1.5"><span class="text-[#666] dark:text-[#999]">ফিচারড</span><span class="font-semibold">{{ $stats['featured'] }}</span></div>
                <div class="flex justify-between"><span class="text-[#666] dark:text-[#999]">নির্ধারিত</span><span class="font-semibold">{{ $stats['scheduled'] }}</span></div>
            </div>
        </div>

        @if($topViewed->isNotEmpty())
        <div class="admin-card p-5">
            <h2 class="text-sm font-bold mb-3 flex items-center gap-2">
                <svg class="h-4 w-4 text-[#666] dark:text-[#999]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                সর্বাধিক পঠিত
            </h2>
            <div class="space-y-2">
                @foreach($topViewed as $article)
                <div class="flex items-center gap-2 text-sm py-1 border-b border-[#e0e0e0] dark:border-[#333] last:border-0">
                    <span class="text-[10px] font-bold text-[#ccc] dark:text-[#555] w-4 shrink-0 text-right">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="truncate flex-1">{{ Str::limit($article->title_bn, 40) }}</span>
                    <span class="text-xs text-[#999] dark:text-[#777] shrink-0">{{ number_format($article->view_count) }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($recentComments->isNotEmpty())
        <div class="admin-card p-5">
            <h2 class="text-sm font-bold mb-3 flex items-center gap-2">
                <svg class="h-4 w-4 text-[#666] dark:text-[#999]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                সর্বশেষ মন্তব্য
            </h2>
            <div class="space-y-2">
                @foreach($recentComments as $comment)
                <div class="text-sm py-2 border-b border-[#e0e0e0] dark:border-[#333] last:border-0">
                    <p class="text-xs text-[#666] dark:text-[#999]">{{ Str::limit($comment->body, 60) }}</p>
                    <p class="text-[10px] text-[#999] dark:text-[#777] mt-0.5">
                        <span class="font-medium">{{ $comment->user?->name }}</span>
                        @if($comment->article?->title_bn)
                        <span class="mx-1">—</span>
                        <span>{{ Str::limit($comment->article->title_bn, 25) }}</span>
                        @endif
                    </p>
                </div>
                @endforeach
            </div>
            <a href="{{ route('admin.comments.index') }}" class="text-xs text-[#999] dark:text-[#777] hover:text-[#0d0d0d] dark:hover:text-white transition mt-2 inline-block flex items-center gap-1">
                সব মন্তব্য
                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        @endif
    </div>
</div>

@if($articlesByCategory->isNotEmpty())
<div class="mt-6 admin-card p-5">
    <h2 class="text-sm font-bold mb-3 flex items-center gap-2">
        <svg class="h-4 w-4 text-[#666] dark:text-[#999]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
        বিভাগ অনুযায়ী আর্টিকেল
    </h2>
    <div class="flex flex-wrap gap-2">
        @foreach($articlesByCategory as $item)
        <span class="text-xs bg-[#f5f5f5] dark:bg-[#2a2a2a] px-3 py-1.5 text-[#666] dark:text-[#999]">
            {{ $item->category?->name_bn ?? ' uncategorized' }}: <strong class="text-[#0d0d0d] dark:text-white">{{ $item->total }}</strong>
        </span>
        @endforeach
    </div>
</div>
@endif
@endsection
