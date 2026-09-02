<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" type="image/x-icon" href="{{ \App\Models\Setting::get('site_favicon') ? Storage::url(\App\Models\Setting::get('site_favicon')) : asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ \App\Models\Setting::get('site_favicon') ? Storage::url(\App\Models\Setting::get('site_favicon')) : asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link 
href="https://fonts.bunny.net/css?family=playfair-display:400,700,900|noto-sans-bengali:400,500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <script>if (localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) { document.documentElement.classList.add('dark'); }</script>
</head>
<body class="bg-[#f5f5f5] dark:bg-[#121212] text-[#1a1a1a] dark:text-[#e0e0e0] font-['Hind_Siliguri'] antialiased min-h-screen">
    @yield('content')
    @stack('scripts')
</body>
</html>
