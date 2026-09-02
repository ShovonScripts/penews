@extends('layouts.app')
@section('title', 'প্রাইভেসি পলিসি')
@section('meta_description', 'PEN News-এর প্রাইভেসি পলিসি — ব্যবহারকারীর তথ্য সংগ্রহ, সংরক্ষণ ও ব্যবহার সম্পর্কিত নীতিমালা।')
@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold font-['Playfair_Display'] dark:text-white">প্রাইভেসি পলিসি</h1>
        <div class="w-12 h-1 bg-[#E02020] mt-3"></div>
        <p class="text-sm text-[#666] dark:text-[#aaa] mt-3">সর্বশেষ আপডেট: {{ date('j F, Y') }}</p>
    </div>

    <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-6 md:p-8 page-content">
        {!! $content !!}
    </div>
</div>
@endsection
