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
    <body class="bg-[#FDFDFC] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden shadow-2xl">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5  text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5  border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
       
    <!-- Hero Section -->
    <section class="hero-bg py-16 md:py-24 mt-8">
    <div class="container">
      <div class="flex flex-col lg:flex-row items-center">
        <!-- Hero Content -->
        <div class="w-full lg:w-1/2 mb-12 lg:mb-0 animate-fade-in">
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-800 leading-tight mb-6">
            Enchanced your Android <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-green-400">Performance now!</span>
          </h1>
          <p class="text-xl text-gray-600 mb-8 max-w-xl">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi rerum autem nostrum esse, veniam excepturi nihil suscipit earum possimus tempora!
          </p>
          <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            <button class="bg-green-500 px-8 py-4 rounded-full text-lg font-medium">
              Get Started Now
            </button>
            <button class="px-8 py-4 rounded-full text-lg font-medium border-2 border-green-500 text-green-600 hover:bg-green-50 transition">
              View Our Work
            </button>
          </div>
          <div class="mt-10 flex items-center">
            <div class="flex -space-x-3">
              <div class="w-10 h-10 rounded-full bg-green-200 border-2 border-white"></div>
              <div class="w-10 h-10 rounded-full bg-green-300 border-2 border-white"></div>
              <div class="w-10 h-10 rounded-full bg-green-400 border-2 border-white"></div>
              <div class="w-10 h-10 rounded-full bg-green-500 border-2 border-white flex items-center justify-center text-white font-medium">+15</div>
            </div>
            <div class="ml-4">
              <p class="font-medium text-gray-800">Trusted by customer</p>
              <div class="flex items-center">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <p class="ml-1 text-gray-600"><span class="font-bold text-gray-800">4.9/5</span> (100+ reviews)</p>
              </div>
            </div>
          </div>
        </div>
        <!-- Hero Image -->
        <div class="w-full lg:w-1/2 flex justify-center">
          <div class="relative">
            <div class="absolute -top-6 -right-6 w-64 h-64 bg-green-500 rounded-full opacity-10"></div>
            <div class="absolute -bottom-6 -left-6 w-72 h-72 bg-green-400 rounded-full opacity-10"></div>
            <div class="relative bg-gradient-to-br from-white to-gray-100 p-8 rounded-3xl shadow-2xl transform rotate-3">
              <div class="bg-gray-800 rounded-2xl overflow-hidden shadow-lg">
                <div class="bg-gray-900 h-8 flex items-center px-4">
                  <div class="flex space-x-2">
                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                  </div>
                </div>
                <div class="p-6">
                  <div class="flex justify-between items-center mb-4">
                    <div class="text-white font-bold text-xl">After Modded</div>
                    <div class="text-green-400 font-medium">Android Device</div>
                  </div>
                  <div class="grid grid-cols-3 gap-4">
                    <div class="bg-gray-700 rounded-lg p-3 text-center">
                      <div class="text-green-400 text-2xl font-bold">2x</div>
                      <div class="text-gray-400 text-sm">Performance</div>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-3 text-center">
                      <div class="text-green-400 text-2xl font-bold">5h+</div>
                      <div class="text-gray-400 text-sm">Battery Life</div>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-3 text-center">
                      <div class="text-green-400 text-2xl font-bold">100%</div>
                      <div class="text-gray-400 text-sm">Customizable</div>
                    </div>
                  </div>
                  <div class="mt-6 bg-gradient-to-r from-green-600 to-green-700 rounded-lg p-4 text-center">
                    <div class="text-white font-bold">Optimized for Gaming</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>