<x-app-layout>

    @push('styles')
    <style>
        .reveal-on-scroll { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease-out, transform 0.6s ease-out; }
        .reveal-on-scroll.visible { opacity: 1; transform: translateY(0); }
        .faq-content { max-height: 0; overflow: hidden; transition: max-height 0.5s ease-in-out; }
    </style>
    @endpush

    <main id="top" class="container mx-auto px-6 py-12 md:py-20 max-w-5xl">

        {{-- Header --}}
        <header class="text-center mb-16 reveal-on-scroll">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900">Layanan Custom ROM Android</h1>
            <p class="mt-4 text-lg text-gray-600">Rasakan pengalaman Android yang lebih cepat, fitur eksklusif, dan tampilan yang sepenuhnya dapat disesuaikan dengan pemasangan Custom ROM pada perangkat Anda.</p>
        </header>

        <hr class="my-16 border-gray-200">

        {{-- Deskripsi Layanan --}}
        <section class="flex flex-col md:flex-row items-center gap-12 reveal-on-scroll">
            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold mb-4 text-gray-900">Deskripsi Layanan</h2>
                <p class="text-gray-700 leading-relaxed">
                    Custom ROM adalah sistem operasi Android yang telah dimodifikasi oleh komunitas atau pengembang independen. Dengan memasang Custom ROM, Anda dapat menikmati fitur-fitur terbaru, performa yang lebih optimal, tampilan yang unik, serta kontrol penuh atas perangkat Anda. Layanan kami membantu Anda memilih dan menginstal Custom ROM terbaik sesuai kebutuhan, tanpa ribet dan aman.
                </p>
            </div>
            <div class="md:w-1/2">
                <img src="https://raw.githubusercontent.com/ditlabs/image-project-1/refs/heads/main/services/custom-rom.png" alt="Ilustrasi Custom ROM Android" class="rounded-lg shadow-lg w-full h-auto object-cover">
            </div>
        </section>

        <hr class="my-16 border-gray-200">

        {{-- Manfaat Utama --}}
        <section class="reveal-on-scroll">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Manfaat Utama Custom ROM</h2>
                <p class="mt-2 text-gray-600">Keunggulan yang bisa Anda dapatkan dengan Custom ROM.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">🚀</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Performa Lebih Cepat</h3>
                        <p class="text-sm text-gray-600">Custom ROM seringkali lebih ringan dan dioptimalkan sehingga perangkat Anda berjalan lebih lancar dan responsif.</p>
                    </div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">🎨</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Tampilan & Tema Bebas</h3>
                        <p class="text-sm text-gray-600">Ubah tampilan Android Anda dengan tema, ikon, dan fitur kustomisasi yang tidak tersedia di ROM bawaan.</p>
                    </div>
                </div>
                 <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">🔋</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Hemat Baterai</h3>
                        <p class="text-sm text-gray-600">Beberapa Custom ROM menawarkan pengelolaan baterai yang lebih baik sehingga perangkat lebih awet digunakan seharian.</p>
                    </div>
                </div>
                 <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">🛡️</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Kontrol Privasi & Fitur Eksklusif</h3>
                        <p class="text-sm text-gray-600">Nikmati fitur privasi tambahan, update keamanan lebih cepat, dan akses ke fitur eksklusif yang tidak ada di ROM pabrikan.</p>
                    </div>
                </div>
            </div>
        </section>

        <hr class="my-16 border-gray-200">

        {{-- FAQ --}}
        <section id="faq" class="reveal-on-scroll">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Pertanyaan yang Sering Diajukan</h2>
            </div>
            <div class="max-w-3xl mx-auto space-y-4">
                <div class="faq-item border border-gray-200 rounded-lg">
                    <button class="faq-question w-full text-left font-semibold cursor-pointer p-4 flex justify-between items-center gap-4">
                        <span>Apa risiko terbesar dari memasang Custom ROM?</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div class="faq-content">
                        <p class="p-4 pt-0 text-gray-600">
                            Risiko utama adalah kemungkinan kehilangan garansi, bug pada ROM yang belum stabil, atau kegagalan instalasi yang dapat menyebabkan bootloop. Namun, kami akan memastikan proses instalasi dilakukan dengan aman dan backup data sebelum memulai.
                        </p>
                    </div>
                </div>
                <div class="faq-item border border-gray-200 rounded-lg">
                    <button class="faq-question w-full text-left font-semibold cursor-pointer p-4 flex justify-between items-center gap-4">
                        <span>Apakah bisa kembali ke ROM bawaan setelah menggunakan Custom ROM?</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div class="faq-content">
                        <p class="p-4 pt-0 text-gray-600">
                            Tentu saja! Anda dapat kembali ke ROM bawaan (stock ROM) kapan saja dengan melakukan flashing ulang. Kami juga menyediakan layanan untuk mengembalikan perangkat ke kondisi semula jika dibutuhkan.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <hr class="my-16 border-gray-200">

        {{-- Tombol Kembali --}}
        <section class="text-center reveal-on-scroll">
             <a href="{{ url('/#service') }}" class="bg-green-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-green-700 transition-colors duration-300 shadow-lg hover:shadow-xl">
                <span class="mr-2">←</span> Kembali ke Semua Layanan
            </a>
        </section>

    </main>

    @push('scripts')
    <script>
        // Definisikan fungsi yang akan dipanggil oleh layout utama
        function initPageScripts() {
            // Fungsionalitas FAQ Accordion
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

            // Fungsionalitas Animasi saat Scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.1 });
            const elementsToReveal = document.querySelectorAll('.reveal-on-scroll');
            elementsToReveal.forEach(el => observer.observe(el));
        }
    </script>
    @endpush
</x-app-layout>