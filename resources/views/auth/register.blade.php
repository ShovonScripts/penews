@extends('layouts.guest')

@section('title', 'নিবন্ধন - ' . config('app.name'))

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-lg">
        <div class="text-center mb-8">
            <a href="/" class="font-serif font-bold text-4xl text-[#0d0d0d] dark:text-white">PEN</a>
            <p class="text-[#666] dark:text-[#999] text-sm mt-1">প্রাথমিক শিক্ষা নিউজ</p>
        </div>

        <div class="bg-white dark:bg-[#1e1e1e] rounded-sm shadow-sm border border-[#e0e0e0] dark:border-[#333] p-8">
            <h1 class="text-2xl font-bold mb-6 dark:text-white">নতুন একাউন্ট খুলুন</h1>

            @if ($errors->any())
                <div class="bg-red-50 dark:bg-red-950/20 border-l-4 border-[#E02020] p-4 mb-6">
                    <ul class="text-sm text-[#E02020] dark:text-red-400 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">নাম *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">ইমেইল *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">পাসওয়ার্ড *</label>
                    <input type="password" name="password" required minlength="6"
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">পাসওয়ার্ড নিশ্চিত করুন *</label>
                    <input type="password" name="password_confirmation" required minlength="6"
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">মোবাইল নম্বর *</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="০১৭XXXXXXXX"
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">জেলা *</label>
                        <select name="district_id" required
                            class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                            <option value="">জেলা নির্বাচন করুন</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" @selected(old('district_id') == $district->id)>{{ $district->name_bn }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">উপজেলা *</label>
                        <input type="text" name="upazila" value="{{ old('upazila') }}" required
                            class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">বিদ্যালয়ের নাম *</label>
                    <input type="text" name="school_name" value="{{ old('school_name') }}" required
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">পদবী *</label>
                    <select name="designation" required
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                        <option value="">পদবী নির্বাচন করুন</option>
                        <option value="সহকারী শিক্ষক" @selected(old('designation') == 'সহকারী শিক্ষক')>সহকারী শিক্ষক</option>
                        <option value="প্রধান শিক্ষক" @selected(old('designation') == 'প্রধান শিক্ষক')>প্রধান শিক্ষক</option>
                        <option value="সহকারী প্রধান শিক্ষক" @selected(old('designation') == 'সহকারী প্রধান শিক্ষক')>সহকারী প্রধান শিক্ষক</option>
                        <option value="সিনিয়র শিক্ষক" @selected(old('designation') == 'সিনিয়র শিক্ষক')>সিনিয়র শিক্ষক</option>
                        <option value="ইন্সট্রাক্টর" @selected(old('designation') == 'ইন্সট্রাক্টর')>ইন্সট্রাক্টর</option>
                        <option value="অন্যান্য" @selected(old('designation') == 'অন্যান্য')>অন্যান্য</option>
                    </select>
                </div>

                <button type="submit"
                    class="w-full bg-[#0d0d0d] dark:bg-[#333] text-white py-3 font-medium hover:bg-black/80 dark:hover:bg-[#444] transition text-sm">
                    নিবন্ধন করুন
                </button>
            </form>

            <p class="text-center text-sm text-[#666] dark:text-[#999] mt-6">
                ইতিমধ্যে একাউন্ট আছে?
                <a href="{{ route('login') }}" class="text-[#E02020] hover:underline">লগইন করুন</a>
            </p>
        </div>
    </div>
</div>
@endsection
