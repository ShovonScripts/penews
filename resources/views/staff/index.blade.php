@extends('layouts.app')
@section('title', 'আমাদের টিম - ' . config('app.name'))
@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">

  {{-- Masthead --}}
  <div class="border-t-[3px] border-b border-[#0d0d0d] dark:border-white py-6 mb-12 text-center">
    <p class="text-xs font-medium tracking-[0.2em] uppercase text-[#666] dark:text-[#999] mb-2">প্রাথমিক শিক্ষা নিউজ</p>
    <h1 class="font-['Playfair_Display'] text-4xl md:text-5xl font-medium text-[#0d0d0d] dark:text-white tracking-tight">আমাদের টিম</h1>
    <p class="text-sm text-[#666] dark:text-[#999] mt-2">সম্পাদক, প্রতিবেদক ও উপদেষ্টাগণ</p>
  </div>

  @foreach($staffGroups as $type => $members)
  <div class="mb-12">

    {{-- Section divider --}}
    <div class="flex items-center gap-4 mb-6">
      <span class="flex-1 h-px bg-[#0d0d0d] dark:bg-white"></span>
      <span class="text-xs font-medium tracking-[0.2em] uppercase text-[#0d0d0d] dark:text-white">{{ $typeLabels[$type] ?? $type }}</span>
      <span class="flex-1 h-px bg-[#0d0d0d] dark:bg-white"></span>
    </div>

    {{-- Card grid with flush shared borders --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 border-t border-l border-[#e0e0e0] dark:border-[#333]">
      @foreach($members as $person)
      <a href="{{ route('staff.articles', $person) }}"
         class="border-r border-b border-[#e0e0e0] dark:border-[#333] flex flex-col group bg-white dark:bg-[#0d0d0d] hover:bg-[#f5f5f5] dark:hover:bg-[#1a1a1a] transition-colors duration-150">

        {{-- Photo --}}
        <div class="aspect-square overflow-hidden bg-[#0d0d0d] dark:bg-[#0a0a0a]">
          @if($person->photo)
            <img src="{{ $person->photo }}" alt=""
                 class="w-full h-full object-cover grayscale group-hover:grayscale-[60%] transition duration-300">
          @else
            <div class="w-full h-full flex items-center justify-center">
              <span class="font-['Playfair_Display'] text-6xl font-medium text-white/20 leading-none">{{ mb_substr($person->name_bn, 0, 1) }}</span>
            </div>
          @endif
        </div>

        {{-- Body --}}
        <div class="p-3.5 flex flex-col flex-1 border-t-2 border-[#0d0d0d] dark:border-white">
          <p class="text-sm font-medium text-[#0d0d0d] dark:text-white leading-snug">{{ $person->name_bn }}</p>
          @if($person->designation_bn)
            <p class="text-xs tracking-[0.06em] uppercase text-[#666] dark:text-[#777] mt-1">{{ $person->designation_bn }}</p>
          @endif
          @if($person->bio_bn)
            <p class="text-xs text-[#888] dark:text-[#666] mt-2 leading-relaxed line-clamp-2 flex-1">{{ Str::limit($person->bio_bn, 90) }}</p>
          @else
            <div class="flex-1"></div>
          @endif
          <div class="flex justify-end items-center mt-3 pt-2.5 border-t border-[#e0e0e0] dark:border-[#333]">
            <span class="text-xs tracking-[0.08em] uppercase text-[#666] dark:text-[#777] flex items-center gap-1">
              সংবাদ
              <svg class="h-2.5 w-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </span>
          </div>
        </div>

      </a>
      @endforeach
    </div>
  </div>
  @endforeach

  @if($staffGroups->isEmpty())
  <div class="text-center py-16 border border-[#e0e0e0] dark:border-[#333]">
    <p class="text-sm text-[#999] dark:text-[#777]">কোনো স্টাফ তথ্য পাওয়া যায়নি।</p>
  </div>
  @endif
</div>
@endsection