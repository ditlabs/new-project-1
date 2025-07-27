<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
        @endif
    </head>
    <body>
        <header class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="shrink-0 flex items-center">
                <a href="{{ url('/') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if (Route::has('login'))
                    <nav class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-3 py-2 text-sm font-medium text-gray-500 rounded-md hover:text-gray-700">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-3 py-2 text-sm font-medium text-gray-500 rounded-md hover:text-gray-700">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </div>
    </div>
</header>
       
    <!-- Hero Section -->
    <x-hero/>

    <!-- About Section -->
    <x-about/>

    <!-- Services Section -->
    <x-services/>

    <!-- Testimonials Section -->
    <x-testimonials/>
    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
    </body>
</html>