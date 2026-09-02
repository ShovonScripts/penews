@extends('layouts.app')

@section('title', 'প্রোফাইল সম্পাদনা - ' . config('app.name'))

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <div class="mb-6">
        <a href="{{ route('profile.show') }}" class="inline-flex items-center gap-1 text-sm text-[#666] dark:text-[#999] hover:text-[#E02020] transition">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            প্রোফাইলে ফিরুন
        </a>
    </div>

    <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-8">
        <h1 class="text-2xl font-bold mb-8 dark:text-white">প্রোফাইল সম্পাদনা</h1>

        @if (session('success'))
            <div class="bg-green-50 dark:bg-green-950/20 border-l-4 border-green-600 p-4 mb-6 text-sm text-green-800 dark:text-green-400">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 dark:bg-red-950/20 border-l-4 border-[#E02020] p-4 mb-6">
                <ul class="text-sm text-[#E02020] dark:text-red-400 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">নাম *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">ইমেইল</label>
                    <input type="email" value="{{ $user->email }}" disabled
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#1a1a1a] dark:text-[#888] px-4 py-2.5 text-sm bg-gray-50 cursor-not-allowed">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">ফোন</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">দেশ</label>
                    <input type="text" name="country" value="{{ old('country', $user->country) }}" placeholder="বাংলাদেশ"
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">জন্মদিন</label>
                    <input type="date" name="birthday" value="{{ old('birthday', $user->birthday?->format('Y-m-d')) }}"
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">লিঙ্গ</label>
                    <select name="gender"
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                        <option value="">নির্বাচন করুন</option>
                        <option value="পুরুষ" @selected(old('gender', $user->gender) == 'পুরুষ')>পুরুষ</option>
                        <option value="নারী" @selected(old('gender', $user->gender) == 'নারী')>নারী</option>
                        <option value="অন্যান্য" @selected(old('gender', $user->gender) == 'অন্যান্য')>অন্যান্য</option>
                    </select>
                </div>
            </div>

            <div class="border-t border-[#e0e0e0] dark:border-[#333] pt-5">
                <h3 class="font-semibold text-sm text-[#666] dark:text-[#999] mb-4">ঠিকানা ও পেশাগত তথ্য</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">জেলা</label>
                        <select name="district_id"
                            class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                            <option value="">নির্বাচন করুন</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" @selected(old('district_id', $user->district_id) == $district->id)>{{ $district->name_bn }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">উপজেলা</label>
                        <input type="text" name="upazila" value="{{ old('upazila', $user->upazila) }}"
                            class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">বিদ্যালয়</label>
                        <input type="text" name="school_name" value="{{ old('school_name', $user->school_name) }}"
                            class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#666] dark:text-[#999] mb-1">পদবী</label>
                        <select name="designation"
                            class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-2.5 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888] transition">
                            <option value="">নির্বাচন করুন</option>
                            <option value="সহকারী শিক্ষক" @selected(old('designation', $user->designation) == 'সহকারী শিক্ষক')>সহকারী শিক্ষক</option>
                            <option value="প্রধান শিক্ষক" @selected(old('designation', $user->designation) == 'প্রধান শিক্ষক')>প্রধান শিক্ষক</option>
                            <option value="সহকারী প্রধান শিক্ষক" @selected(old('designation', $user->designation) == 'সহকারী প্রধান শিক্ষক')>সহকারী প্রধান শিক্ষক</option>
                            <option value="সিনিয়র শিক্ষক" @selected(old('designation', $user->designation) == 'সিনিয়র শিক্ষক')>সিনিয়র শিক্ষক</option>
                            <option value="ইন্সট্রাক্টর" @selected(old('designation', $user->designation) == 'ইন্সট্রাক্টর')>ইন্সট্রাক্টর</option>
                            <option value="অন্যান্য" @selected(old('designation', $user->designation) == 'অন্যান্য')>অন্যান্য</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-[#e0e0e0] dark:border-[#333]">
                <button type="submit"
                    class="bg-[#0d0d0d] dark:bg-[#333] text-white px-6 py-2.5 text-sm font-medium hover:bg-black/80 dark:hover:bg-[#444] transition">
                    সংরক্ষণ করুন
                </button>
                <a href="{{ route('profile.show') }}"
                    class="border border-[#e0e0e0] dark:border-[#444] px-6 py-2.5 text-sm hover:bg-gray-50 dark:hover:bg-[#2a2a2a] transition dark:text-[#e0e0e0]">
                    বাতিল
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
