@extends('layouts.admin')
@section('title', 'সেটিংস')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-2">
        <svg class="h-6 w-6 text-[#999]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        <h1 class="text-2xl font-bold">সেটিংস</h1>
    </div>
</div>

<div class="flex gap-0.5 mb-6 text-sm flex-wrap border-b border-[#e0e0e0] dark:border-[#333]">
    <a href="{{ route('admin.settings.index', ['tab' => 'general']) }}" class="px-4 py-2.5 font-medium transition border-b-2 flex items-center gap-1.5 @if($tab === 'general') border-[#E02020] text-[#E02020] @else border-transparent text-[#999] hover:text-[#666] @endif">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        জেনারেল
    </a>
    <a href="{{ route('admin.settings.index', ['tab' => 'social']) }}" class="px-4 py-2.5 font-medium transition border-b-2 flex items-center gap-1.5 @if($tab === 'social') border-[#E02020] text-[#E02020] @else border-transparent text-[#999] hover:text-[#666] @endif">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
        সোশ্যাল
    </a>
    <a href="{{ route('admin.settings.index', ['tab' => 'footer']) }}" class="px-4 py-2.5 font-medium transition border-b-2 flex items-center gap-1.5 @if($tab === 'footer') border-[#E02020] text-[#E02020] @else border-transparent text-[#999] hover:text-[#666] @endif">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M3 8h18M3 12h18M3 16h18M3 20h18"/></svg>
        ফুটার
    </a>
    <a href="{{ route('admin.settings.index', ['tab' => 'email']) }}" class="px-4 py-2.5 font-medium transition border-b-2 flex items-center gap-1.5 @if($tab === 'email') border-[#E02020] text-[#E02020] @else border-transparent text-[#999] hover:text-[#666] @endif">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        ইমেইল
    </a>
    <a href="{{ route('admin.settings.index', ['tab' => 'seo']) }}" class="px-4 py-2.5 font-medium transition border-b-2 flex items-center gap-1.5 @if($tab === 'seo') border-[#E02020] text-[#E02020] @else border-transparent text-[#999] hover:text-[#666] @endif">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        SEO
    </a>
    <a href="{{ route('admin.settings.index', ['tab' => 'tools']) }}" class="px-4 py-2.5 font-medium transition border-b-2 flex items-center gap-1.5 @if($tab === 'tools') border-[#E02020] text-[#E02020] @else border-transparent text-[#999] hover:text-[#666] @endif">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        টুলস
    </a>
    <a href="{{ route('admin.ads.index') }}" class="px-4 py-2.5 font-medium transition border-b-2 flex items-center gap-1.5 @if(request()->routeIs('admin.ads.*')) border-[#E02020] text-[#E02020] @else border-transparent text-[#999] hover:text-[#666] @endif">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
        বিজ্ঞাপন
    </a>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <input type="hidden" name="tab" value="{{ $tab }}">

    {{-- General --}}
    @if($tab === 'general')
    <div class="max-w-2xl space-y-6">
        <div class="admin-card p-6">
            <h2 class="text-sm font-bold mb-4">সাইটের তথ্য</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">সাইটের নাম (বাংলা)</label>
                    <input type="text" name="site_name_bn" value="{{ old('site_name_bn', $settings['site_name_bn']->value ?? '') }}" class="admin-input w-full">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">সাইটের নাম (ইংরেজি)</label>
                    <input type="text" name="site_name_en" value="{{ old('site_name_en', $settings['site_name_en']->value ?? '') }}" class="admin-input w-full">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">ট্যাগলাইন</label>
                    <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline']->value ?? '') }}" class="admin-input w-full">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">লোগো</label>
                    <input type="file" name="site_logo" accept="image/png,image/jpeg,image/webp,image/svg+xml" class="admin-input w-full file:bg-[#f5f5f5] file:border-0 file:px-3 file:py-1.5 file:text-sm file:mr-3">
                    @if(!empty($settings['site_logo']->value ?? ''))
                    <div class="mt-2 flex items-center gap-3">
                        <img src="{{ Storage::url($settings['site_logo']->value) }}" class="h-10 border border-[#e0e0e0]">
                        <span class="text-xs text-[#999]">{{ $settings['site_logo']->value }}</span>
                    </div>
                    @endif
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">ফেভিকন</label>
                    <input type="file" name="site_favicon" accept="image/png,image/x-icon,image/jpeg" class="admin-input w-full file:bg-[#f5f5f5] file:border-0 file:px-3 file:py-1.5 file:text-sm file:mr-3">
                    @if(!empty($settings['site_favicon']->value ?? ''))
                    <div class="mt-2 flex items-center gap-3">
                        <img src="{{ Storage::url($settings['site_favicon']->value) }}" class="h-8 border border-[#e0e0e0]">
                        <span class="text-xs text-[#999]">{{ $settings['site_favicon']->value }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="admin-card p-6">
            <h2 class="text-sm font-bold mb-4">প্রিলোডার</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">লোডার ইমেজ (GIF/PNG/SVG)</label>
                    <input type="file" name="site_loader" accept="image/gif,image/png,image/svg+xml" class="admin-input w-full file:bg-[#f5f5f5] file:border-0 file:px-3 file:py-1.5 file:text-sm file:mr-3">
                    @if(!empty($settings['site_loader']->value ?? ''))
                    <div class="mt-2 flex items-center gap-3">
                        <img src="{{ Storage::url($settings['site_loader']->value) }}" class="h-10 border border-[#e0e0e0]">
                        <span class="text-xs text-[#999]">{{ $settings['site_loader']->value }}</span>
                    </div>
                    @endif
                </div>
                <div>
                    <label class="flex items-center gap-2 text-sm">
                        <input type="hidden" name="loader_enabled" value="0">
                        <input type="checkbox" name="loader_enabled" value="1" @checked(($settings['loader_enabled']->value ?? '') === '1') class="h-4 w-4 accent-[#0d0d0d]">
                        <span>প্রিলোডার সক্রিয় করুন</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="admin-card p-6">
            <h2 class="text-sm font-bold mb-4">যোগাযোগ</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">ইমেইল</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']->value ?? '') }}" class="admin-input w-full">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">ফোন</label>
                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone']->value ?? '') }}" class="admin-input w-full">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">ঠিকানা</label>
                    <textarea name="contact_address" rows="2" class="admin-input w-full">{{ old('contact_address', $settings['contact_address']->value ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Social --}}
    @if($tab === 'social')
    <div class="max-w-2xl space-y-6">
        <div class="admin-card p-6">
            <h2 class="text-sm font-bold mb-4">সোশ্যাল মিডিয়া লিংক</h2>
            <div class="space-y-4">
                <div><label class="block text-xs font-medium text-[#666] mb-1">Facebook</label><input type="url" name="social_facebook" value="{{ old('social_facebook', $settings['social_facebook']->value ?? '') }}" class="admin-input w-full" placeholder="https://facebook.com/yourpage"></div>
                <div><label class="block text-xs font-medium text-[#666] mb-1">Twitter / X</label><input type="url" name="social_twitter" value="{{ old('social_twitter', $settings['social_twitter']->value ?? '') }}" class="admin-input w-full" placeholder="https://x.com/yourhandle"></div>
                <div><label class="block text-xs font-medium text-[#666] mb-1">YouTube</label><input type="url" name="social_youtube" value="{{ old('social_youtube', $settings['social_youtube']->value ?? '') }}" class="admin-input w-full" placeholder="https://youtube.com/@yourchannel"></div>
                <div><label class="block text-xs font-medium text-[#666] mb-1">Instagram</label><input type="url" name="social_instagram" value="{{ old('social_instagram', $settings['social_instagram']->value ?? '') }}" class="admin-input w-full" placeholder="https://instagram.com/yourprofile"></div>
                <div><label class="block text-xs font-medium text-[#666] mb-1">LinkedIn</label><input type="url" name="social_linkedin" value="{{ old('social_linkedin', $settings['social_linkedin']->value ?? '') }}" class="admin-input w-full" placeholder="https://linkedin.com/company/yourpage"></div>
                <div><label class="block text-xs font-medium text-[#666] mb-1">WhatsApp নম্বর</label><input type="text" name="social_whatsapp" value="{{ old('social_whatsapp', $settings['social_whatsapp']->value ?? '') }}" class="admin-input w-full" placeholder="+8801XXXXXXXXX"></div>
            </div>
        </div>
    </div>
    @endif

    {{-- Footer --}}
    @if($tab === 'footer')
    <div class="max-w-2xl space-y-6">
        <div class="admin-card p-6">
            <h2 class="text-sm font-bold mb-4">ফুটার কন্টেন্ট</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">ফুটার টেক্সট</label>
                    <textarea name="footer_text" rows="4" class="admin-input w-full">{{ old('footer_text', $settings['footer_text']->value ?? '') }}</textarea>
                    <p class="text-xs text-[#999] mt-1">HTML ট্যাগ ব্যবহার করা যাবে</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">কপিরাইট টেক্সট</label>
                    <input type="text" name="footer_copyright" value="{{ old('footer_copyright', $settings['footer_copyright']->value ?? '') }}" class="admin-input w-full" placeholder="© 2026 PEN News. All rights reserved.">
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Email --}}
    @if($tab === 'email')
    <div class="max-w-2xl space-y-6">
        <div class="admin-card p-6">
            <h2 class="text-sm font-bold mb-4">SMTP সেটিংস</h2>
            <p class="text-xs text-[#999] mb-4">এই সেটিংস .env ফাইলের মান ওভাররাইড করবে না। প্রকৃত মেইল পাঠানোর জন্য .env ফাইল আপডেট করুন।</p>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">SMTP হোস্ট</label>
                    <input type="text" name="email_host" value="{{ old('email_host', $settings['email_host']->value ?? '') }}" class="admin-input w-full" placeholder="smtp.gmail.com">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-[#666] mb-1">পোর্ট</label>
                        <input type="text" name="email_port" value="{{ old('email_port', $settings['email_port']->value ?? '') }}" class="admin-input w-full" placeholder="587">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#666] mb-1">এনক্রিপশন</label>
                        <select name="email_encryption" class="admin-select w-full">
                            <option value="tls" @selected(($settings['email_encryption']->value ?? 'tls') === 'tls')>TLS</option>
                            <option value="ssl" @selected(($settings['email_encryption']->value ?? '') === 'ssl')>SSL</option>
                            <option value="null" @selected(($settings['email_encryption']->value ?? '') === 'null')>None</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">ইউজারনেম</label>
                    <input type="text" name="email_username" value="{{ old('email_username', $settings['email_username']->value ?? '') }}" class="admin-input w-full">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">পাসওয়ার্ড</label>
                    <input type="password" name="email_password" value="{{ old('email_password', $settings['email_password']->value ?? '') }}" class="admin-input w-full">
                    <p class="text-xs text-[#999] mt-1">Gmail এর জন্য App Password ব্যবহার করুন</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">From ইমেইল</label>
                    <input type="email" name="email_from_address" value="{{ old('email_from_address', $settings['email_from_address']->value ?? '') }}" class="admin-input w-full" placeholder="noreply@penews.com">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">From নাম</label>
                    <input type="text" name="email_from_name" value="{{ old('email_from_name', $settings['email_from_name']->value ?? '') }}" class="admin-input w-full" placeholder="PEN News">
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- SEO --}}
    @if($tab === 'seo')
    <div class="max-w-2xl space-y-6">
        <div class="admin-card p-6">
            <h2 class="text-sm font-bold mb-4">SEO & অ্যানালিটিক্স</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">মেটা ডেসক্রিপশন</label>
                    <textarea name="meta_description" rows="3" class="admin-input w-full">{{ old('meta_description', $settings['meta_description']->value ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">মেটা কীওয়ার্ডস</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $settings['meta_keywords']->value ?? '') }}" class="admin-input w-full" placeholder="news, bangladesh, education, primary, ...">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">Google Analytics ID</label>
                    <input type="text" name="google_analytics_id" value="{{ old('google_analytics_id', $settings['google_analytics_id']->value ?? '') }}" class="admin-input w-full" placeholder="G-XXXXXXXXXX">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] mb-1">Google Tag Manager ID</label>
                    <input type="text" name="google_tag_manager_id" value="{{ old('google_tag_manager_id', $settings['google_tag_manager_id']->value ?? '') }}" class="admin-input w-full" placeholder="GTM-XXXXXXX">
                </div>
            </div>
        </div>
        <div class="admin-card p-6">
            <h2 class="text-sm font-bold mb-4">মেইন্টেন্যান্স</h2>
            <div class="space-y-4">
                <div>
                    <label class="flex items-center gap-3 text-sm">
                        <input type="hidden" name="maintenance_mode" value="0">
                        <input type="checkbox" name="maintenance_mode" value="1" @checked(($settings['maintenance_mode']->value ?? '') === '1') class="h-4 w-4 accent-[#E02020]">
                        <span>মেইন্টেন্যান্স মোড সক্রিয় করুন</span>
                    </label>
                    <p class="text-xs text-[#999] mt-1">সক্রিয় করলে শুধু এডমিনরা সাইট দেখতে পারবেন</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Tools --}}
    @if($tab === 'tools')
    <div class="max-w-2xl space-y-6" id="toolsTab">
        <div class="admin-card p-6">
            <h2 class="text-sm font-bold mb-4">ক্যাশ ম্যানেজমেন্ট</h2>
            <p class="text-xs text-[#999] mb-5">নিচের বাটনগুলো ব্যবহার করে বিভিন্ন ক্যাশ ও ডাটা সাফ করতে পারেন।</p>
            <div class="space-y-4">
                <form method="POST" action="{{ route('admin.settings.clear-cache') }}" data-confirm-form>
                    @csrf
                    <div class="flex items-center justify-between p-4 bg-[#fafafa] dark:bg-[#2a2a2a] border border-[#e0e0e0] dark:border-[#444]">
                        <div>
                            <p class="text-sm font-medium">ক্যাশ সাফ করুন</p>
                            <p class="text-xs text-[#999] mt-0.5">config, route, view, cache, compiled — সব ক্যাশ মুছে ফেলে</p>
                        </div>
                        <button type="button" class="bg-[#E02020] text-white text-xs font-medium px-4 py-2 hover:bg-red-700 transition whitespace-nowrap" data-confirm-trigger="সমস্ত ক্যাশ সাফ করবেন?">ক্যাশ সাফ</button>
                    </div>
                </form>
                <form method="POST" action="{{ route('admin.settings.clear-data') }}" data-confirm-form>
                    @csrf
                    <div class="flex items-center justify-between p-4 bg-[#fafafa] dark:bg-[#2a2a2a] border border-[#e0e0e0] dark:border-[#444]">
                        <div>
                            <p class="text-sm font-medium">ডাটা সাফ করুন</p>
                            <p class="text-xs text-[#999] mt-0.5">পেজ ভিউ ও অ্যাক্টিভিটি লগের ডাটা মুছে ফেলে</p>
                        </div>
                        <button type="button" class="bg-[#666] text-white text-xs font-medium px-4 py-2 hover:bg-[#0d0d0d] transition whitespace-nowrap" data-confirm-trigger="পেজ ভিউ ও অ্যাক্টিভিটি লগের সব ডাটা সাফ করবেন?">ডাটা সাফ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Confirmation Modal --}}
    <div id="confirmModal" class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/50 backdrop-blur-sm" role="dialog" aria-modal="true" aria-labelledby="confirmTitle">
        <div class="bg-white dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] w-full max-w-sm mx-4 shadow-2xl">
            <div class="p-5">
                <div class="flex items-start gap-3">
                    <div class="shrink-0 w-10 h-10 flex items-center justify-center bg-red-50 dark:bg-red-900/20">
                        <svg class="h-5 w-5 text-[#E02020]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                    </div>
                    <div>
                        <h3 id="confirmTitle" class="text-sm font-bold dark:text-white">নিশ্চিত করুন</h3>
                        <p id="confirmMessage" class="text-xs text-[#666] dark:text-[#aaa] mt-1">আপনি কি নিশ্চিত?</p>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-2 mt-5 pt-4 border-t border-[#e0e0e0] dark:border-[#333]">
                    <button type="button" id="confirmCancel" class="px-4 py-2 text-xs font-medium text-[#666] dark:text-[#aaa] hover:bg-[#f5f5f5] dark:hover:bg-[#2a2a2a] transition border border-[#e0e0e0] dark:border-[#444]">বাতিল</button>
                    <button type="button" id="confirmSubmit" class="px-4 py-2 text-xs font-medium text-white bg-[#E02020] hover:bg-red-700 transition">হ্যাঁ, সাফ করুন</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function() {
        var modal = document.getElementById('confirmModal');
        var messageEl = document.getElementById('confirmMessage');
        var cancelBtn = document.getElementById('confirmCancel');
        var submitBtn = document.getElementById('confirmSubmit');
        var targetForm = null;

        document.querySelectorAll('[data-confirm-trigger]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                targetForm = btn.closest('[data-confirm-form]');
                messageEl.textContent = btn.getAttribute('data-confirm-trigger');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                submitBtn.focus();
            });
        });

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            targetForm = null;
        }

        cancelBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });

        submitBtn.addEventListener('click', function() {
            if (targetForm) targetForm.submit();
        });
    })();
    </script>
    @endif

    @if($tab !== 'ads' && $tab !== 'tools')
    <div class="flex justify-end mt-6 max-w-2xl">
        <button type="submit" class="btn-primary">সেটিংস সংরক্ষণ</button>
    </div>
    @endif
</form>
@endsection
