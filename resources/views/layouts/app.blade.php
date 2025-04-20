<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/dashboard.js'])
</head>

<body class="bg-[#f5f5f5] flex flex-col min-h-screen">

    {{-- Navbar --}}
    @include('layouts.navigation')

    {{-- Sidebar --}}
    @include('layouts.sidebar')
    <div class="flex pt-22 pl-66 flex-1 transition-all duration-300 ease-in-out" id="main-container">

        {{-- Main content --}}
        <main class="flex-1 p-6 overflow-y-auto">
            <h1 class="text-3xl mb-6 font-semibold text-gray-800">
                @yield('header', 'Default Header Title')
            </h1>
            <div class="w-full bg-background-primary shadow rounded border-t-5 p-6 border-primary">

                @yield('content')
            </div>
        </main>
    </div>

    {{-- Footer --}}
    <footer class="w-full bg-primary shadow-sm h-16 mt-auto"></footer>

</body>

</html>
