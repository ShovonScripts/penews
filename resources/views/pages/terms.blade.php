@extends('layouts.app')
@section('title', 'শর্তাবলী ও নিয়মাবলী')
@section('meta_description', 'PEN News-এর শর্তাবলী ও নিয়মাবলী — ওয়েবসাইট ব্যবহারের নিয়ম ও শর্তাবলী সম্পর্কিত।')
@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold font-serif dark:text-white">শর্তাবলী ও নিয়মাবলী</h1>
        <div class="w-12 h-1 bg-[#E02020] mt-3"></div>
        <p class="text-sm text-[#666] dark:text-[#aaa] mt-3">সর্বশেষ আপডেট: {{ date('j F, Y') }}</p>
    </div>

    <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-6 md:p-8 page-content">
        {!! $content !!}
    </div>
</div>
@endsection
