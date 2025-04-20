<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-white antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-primary">

        <div class="w-full sm:max-w-2xl px-16 py-10 bg-secondary shadow-md overflow-hidden rounded-[77px]">
            <div class="w-full h-full flex items-center justify-center flex-col mb-4">
                <a href="/">
                    <img src="{{ asset('images/logo.webp') }}" alt="Logo" class="h-57.5 w-57.5">
                </a>
                <h1 class="text-black text-center text-4xl">Sistem Peminjaman Fasilitas Kampus Politeknik Negeri Malang
                </h1>
            </div>
            {{ $slot }}
        </div>
    </div>
</body>

</html>
