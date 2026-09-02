<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" type="image/x-icon" href="{{ \App\Models\Setting::get('site_favicon') ? Storage::url(\App\Models\Setting::get('site_favicon')) : asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ \App\Models\Setting::get('site_favicon') ? Storage::url(\App\Models\Setting::get('site_favicon')) : asset('favicon.ico') }}">
    @hasSection('meta_description')
    <meta name="description" content="@yield('meta_description')">
    @endif
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link 
href="https://fonts.bunny.net/css?family=playfair-display:400,700,900|noto-sans-bengali:400,500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <script>if(localStorage.getItem('darkMode')==='true'||(!localStorage.getItem('darkMode')&&window.matchMedia('(prefers-color-scheme:dark)').matches))document.documentElement.classList.add('dark');</script>
</head>
<body class="bg-[#f5f5f5] dark:bg-[#121212] text-[#1a1a1a] dark:text-[#e0e0e0] font-['Noto_Sans_Bengali'] antialiased min-h-screen flex flex-col">
    @include('partials.ads.popup')
    @include('partials.header')
    @include('partials.ads.header')
    <main class="flex-1 w-full">
        @yield('content')
    </main>
    @include('partials.ads.footer')
    @include('partials.footer')
    <button id="scrollTop" class="fixed bottom-6 right-6 z-40 w-10 h-10 rounded-full bg-[#E02020] text-white shadow-lg hover:bg-red-700 transition-all duration-300 flex items-center justify-center opacity-0 pointer-events-none">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
    </button>
    @stack('scripts')
</body>
</html>
