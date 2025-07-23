<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $service['title'] }} - Ditlabs</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .reveal-on-scroll { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease-out, transform 0.6s ease-out; }
        .reveal-on-scroll.visible { opacity: 1; transform: translateY(0); }
        .faq-content { max-height: 0; overflow: hidden; transition: max-height 0.5s ease-in-out; }
    </style>
</head>
<body class="bg-white text-gray-800 antialiased">

    <header class="w-full text-sm py-4 px-6 lg:px-8 bg-white/80 backdrop-blur-sm sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="/" class="text-xl font-bold text-green-600">Ditlabs</a>
            <nav class="hidden md:flex items-center justify-end gap-6">
                <a href="/#about" class="text-gray-600 hover:text-green-600">About</a>
                <a href="/#service" class="text-gray-600 hover:text-green-600">Services</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-2 border border-gray-300 hover:border-gray-400 text-gray-800 rounded-lg">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-600">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-block px-5 py-2 bg-green-600 text-white hover:bg-green-700 rounded-lg">Register</a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>

    <main id="top" class="container mx-auto px-6 py-12 md:py-20 max-w-5xl">

        <header class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900">{{ $service['title'] }}</h1>
            <p class="mt-4 text-lg text-gray-600">{{ $service['subtitle'] }}</p>
        </header>

        <hr class="my-16 border-gray-200">

        <section class="flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold mb-4 text-gray-900">Deskripsi Layanan</h2>
                <p class="text-gray-700 leading-relaxed">{{ $service['overview'] }}</p>
            </div>
            <div class="md:w-1/2">
                <img src="{{ $service['image_url'] }}" alt="Ilustrasi untuk {{ $service['title'] }}" class="rounded-lg shadow-lg w-full h-64 object-cover">
            </div>
        </section>

        <hr class="my-16 border-gray-200">

        <section>
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Manfaat Utama</h2>
                <p class="mt-2 text-gray-600">Keuntungan yang akan Anda rasakan secara langsung.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($service['benefits'] as $benefit)
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">{{ $benefit['icon'] }}</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">{{ $benefit['title'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $benefit['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <hr class="my-16 border-gray-200">

        <section>
             <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Proses Kami yang Terstruktur</h2>
                <p class="mt-2 text-gray-600">Transparansi dan keamanan adalah prioritas kami di setiap langkah.</p>
            </div>
            <div class="relative">
                <div class="hidden md:block absolute w-px h-full bg-green-200 top-0 left-1/2 transform -translate-x-1/2"></div>
                <div class="space-y-12 md:space-y-0">
                    @foreach($service['process'] as $step)
                        <div class="flex flex-col md:flex-row items-center reveal-on-scroll">
                            @if($loop->odd)
                                <div class="md:w-1/2 md:pr-8 md:text-right">
                                    <h3 class="font-bold text-xl text-green-600">Langkah {{ $step['step'] }}: {{ $step['title'] }}</h3>
                                    <p class="text-gray-600 mt-2">{{ $step['description'] }}</p>
                                </div>
                                <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-full bg-green-500 text-white font-bold text-xl shadow-lg z-10">{{ $step['step'] }}</div>
                                <div class="md:w-1/2 md:pl-8"></div>
                            @else
                                <div class="md:w-1/2 md:pl-8 order-3 md:order-1"></div>
                                <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-full bg-green-500 text-white font-bold text-xl shadow-lg z-10 order-2">{{ $step['step'] }}</div>
                                <div class="md:w-1/2 md:pl-8 md:text-left order-1 md:order-3">
                                    <h3 class="font-bold text-xl text-green-600">Langkah {{ $step['step'] }}: {{ $step['title'] }}</h3>
                                    <p class="text-gray-600 mt-2">{{ $step['description'] }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <hr class="my-16 border-gray-200">

        <section id="faq">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Pertanyaan yang Sering Diajukan</h2>
            </div>
            <div class="max-w-3xl mx-auto space-y-4">
                @foreach($service['faqs'] as $faq)
                <div class="faq-item border border-gray-200 rounded-lg">
                    <button class="faq-question w-full text-left font-semibold cursor-pointer p-4 flex justify-between items-center gap-4">
                        <span>{{ $faq['question'] }}</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div class="faq-content">
                        <p class="p-4 pt-0 text-gray-600">{{ $faq['answer'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <hr class="my-16 border-gray-200">

        <section class="text-center">
             <a href="/#service" class="bg-green-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-green-700 transition-colors duration-300 shadow-lg hover:shadow-xl">
                <span class="mr-2">←</span> Kembali ke Semua Layanan
            </a>
        </section>

    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- Fungsionalitas FAQ Accordion ---
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            const content = item.querySelector('.faq-content');
            question.addEventListener('click', () => {
                const isActive = item.classList.contains('active');
                faqItems.forEach(i => {
                    i.classList.remove('active');
                    i.querySelector('.faq-content').style.maxHeight = '0px';
                    i.querySelector('.faq-question svg').classList.remove('rotate-180');
                });
                if (!isActive) {
                    item.classList.add('active');
                    content.style.maxHeight = content.scrollHeight + 'px';
                    question.querySelector('svg').classList.add('rotate-180');
                }
            });
        });
        // --- Fungsionalitas Animasi saat Scroll ---
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        const elementsToReveal = document.querySelectorAll('.reveal-on-scroll');
        elementsToReveal.forEach(el => observer.observe(el));
    });
    </script>
</body>
</html>