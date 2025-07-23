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
  </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-gray-50">
    <div class="container">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-gray-800">About Ditlabs</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto mt-4">We specialize in transforming ordinary Android devices into extraordinary performance machines</p>
      </div>
      
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="animate-fade-in" style="animation-delay: 0.2s">
          <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-8 shadow-lg">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h3>
            <p class="text-gray-600 mb-6">
              At Ditlabs, we believe every Android device has untapped potential. Our mission is to unlock that potential through expert modding, customization, and optimization.
            </p>
            <div class="space-y-4">
              <div class="flex items-start">
                <div class="bg-green-100 p-2 rounded-lg mr-4">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                </div>
                <div>
                  <h4 class="font-bold text-gray-800">Expert Technicians</h4>
                  <p class="text-gray-600">Our team has 2+ years of Android modding experience</p>
                </div>
              </div>
              <div class="flex items-start">
                <div class="bg-green-100 p-2 rounded-lg mr-4">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                </div>
                <div>
                  <h4 class="font-bold text-gray-800">Quality Guarantee</h4>
                  <p class="text-gray-600">7-day satisfaction guarantee on all our services</p>
                </div>
              </div>
              <div class="flex items-start">
                <div class="bg-green-100 p-2 rounded-lg mr-4">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                </div>
                <div>
                  <h4 class="font-bold text-gray-800">Fast Response</h4>
                  <p class="text-gray-600">Secure and fast process service</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="animate-fade-in" style="animation-delay: 0.4s">
          <div class="grid grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl p-6 shadow-lg">
              <div class="text-5xl font-bold text-green-600 mb-2">2+</div>
              <div class="text-gray-800 font-medium">Years Experience</div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-lg">
              <div class="text-5xl font-bold text-green-600 mb-2">100+</div>
              <div class="text-gray-800 font-medium">Devices Modded</div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-lg">
              <div class="text-5xl font-bold text-green-600 mb-2">98%</div>
              <div class="text-gray-800 font-medium">Satisfaction Rate</div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-lg">
              <div class="text-5xl font-bold text-green-600 mb-2">24/7</div>
              <div class="text-gray-800 font-medium">Customer Support</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

    <!-- Services Section -->
  <section id="service" class="py-20 bg-gradient-to-br from-gray-50 to-white">
    <div class="container">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-gray-800">Our Services</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto mt-4">Professional Android modding solutions to enhance your device's performance and functionality</p>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Service 1 -->
        <div class="border border-green-200 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
          <div class="p-6">
            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Custom Rom Installation</h3>
            <p class="text-gray-600 mb-6">
              Install custom Android operating systems for better performance, longer battery life, and newer features on older devices.
            </p>
            <a href="#" class="text-green-600 font-medium flex items-center">
              Learn more
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
        
        <!-- Service 2 -->
        <div class="border border-green-200 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
          <div class="p-6">
            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Tweaking Performance</h3>
            <p class="text-gray-600 mb-6">
              Optimize your device for maximum speed and efficiency, perfect for gaming and multitasking.
            </p>
            <a href="#" class="text-green-600 font-medium flex items-center">
              Learn more
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
        
        <!-- Service 3 -->
        <div class="border border-green-200 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
          <div class="p-6">
            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Root & Unlock</h3>
            <p class="text-gray-600 mb-6">
              Safely root your device to gain full control over the operating system and install powerful apps.
            </p>
            <a href="#" class="text-green-600 font-medium flex items-center">
              Learn more
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
        
        <!-- Service 4 -->
        <div class="border border-green-200 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
          <div class="p-6">
            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Unlock Bootloader</h3>
            <p class="text-gray-600 mb-6">
              Allow Unlocking the bootloader to install custom ROMs and recoveries, giving you full control over your device.
            </p>
            <a href="#" class="text-green-600 font-medium flex items-center">
              Learn more
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
        
        <!-- Service 5 -->
        <div class="border border-green-200 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
          <div class="p-6">
            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Upgrade and Downgrade</h3>
            <p class="text-gray-600 mb-6">
              Update and downgrade your Android OS to the desired version, ensuring compatibility with your favorite apps and features.
            </p>
            <a href="#" class="text-green-600 font-medium flex items-center">
              Learn more
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
        
        <!-- Service 6 -->
        <div class="border border-green-200 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
          <div class="p-6">
            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Consultation & Support</h3>
            <p class="text-gray-600 mb-6">
              Get expert advice and ongoing support for all your Android customization needs.
            </p>
            <a href="#" class="text-green-600 font-medium flex items-center">
              Learn more
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>