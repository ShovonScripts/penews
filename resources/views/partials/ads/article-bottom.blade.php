@php
$ads = \App\Models\Advertisement::where('position', 'article_bottom')
    ->where('is_active', true)
    ->where(function($q) { $q->whereNull('starts_at')->orWhere('starts_at', '<=', now()); })
    ->where(function($q) { $q->whereNull('ends_at')->orWhere('ends_at', '>=', now()); })
    ->orderBy('order')->get();
@endphp
@foreach($ads as $ad)
<div class="my-6">
    <div class="relative group">
        <div class="overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333]">
            @if($ad->type === 'banner')
                <a href="{{ route('admin.ads.click', $ad) }}?url={{ urlencode($ad->link_url) }}" target="_blank" rel="noopener" class="block hover:opacity-90 transition-opacity duration-200">
                    <img src="{{ $ad->image_url }}" alt="{{ $ad->title }}" class="mx-auto" style="max-width:100%;height:auto;">
                </a>
            @else
                {!! $ad->code !!}
            @endif
        </div>
        <img src="{{ route('admin.ads.impression', $ad) }}" alt="" class="hidden" width="1" height="1">
    </div>
</div>
@endforeach
