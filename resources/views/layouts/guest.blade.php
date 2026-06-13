<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-slate-900 via-slate-950 to-sador-blue/30 px-4">
            <div class="mb-8">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" class="h-16 md:h-20 w-auto object-contain mx-auto transform hover:scale-[1.02] transition-transform duration-300" alt="Sador General Construction Logo">
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-10 bg-slate-900/80 backdrop-blur-xl border border-slate-800 shadow-2xl rounded-3xl text-white">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
