@props(['videoUrl', 'title' => null, 'mode' => 'embed', 'aspect' => '16/9'])

@php
$id = null;
if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|v\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $m)) $id = $m[1];
if (!$id) return;
$thumb = "https://img.youtube.com/vi/{$id}/hqdefault.jpg";
$embed = "https://www.youtube.com/embed/{$id}";
@endphp

@if($mode === 'embed')
<div class="relative w-full h-full">
    <iframe src="{{ $embed }}"
        title="{{ $title ?? 'YouTube video' }}"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin"
        allowfullscreen
        class="absolute inset-0 w-full h-full"></iframe>
</div>
@elseif($mode === 'thumb')
<img src="{{ $thumb }}" alt="" loading="lazy" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
<div class="absolute inset-0 bg-black/20 flex items-center justify-center group-hover:bg-black/30 transition">
    <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#E02020]/90 flex items-center justify-center shadow-lg">
        <svg class="w-5 h-5 md:w-6 md:h-6 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
    </div>
</div>
@endif
