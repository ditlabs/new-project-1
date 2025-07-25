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
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900">Optimisasi & Tweak Performa</h1>
            <p class="mt-4 text-lg text-gray-600">Maksimalkan kecepatan dan efisiensi perangkat Anda untuk gaming, multitasking, dan penggunaan harian.</p>
        </header>

        <hr class="my-16 border-gray-200">

        {{-- Deskripsi Layanan --}}
        <section class="flex flex-col md:flex-row items-center gap-12 reveal-on-scroll">
            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold mb-4 text-gray-900">Deskripsi Layanan</h2>
                <p class="text-gray-700 leading-relaxed">Layanan ini dirancang untuk Anda yang ingin mengeluarkan potensi maksimal dari sistem operasi yang sudah ada. Kami melakukan optimisasi mendalam tanpa mengubah OS, termasuk menghapus bloatware, menyesuaikan parameter kernel, dan tuning CPU/GPU untuk mendapatkan responsivitas dan performa terbaik.</p>
            </div>
            <div class="md:w-1/2">
                {{-- Gambar yang disarankan: dashboard/speedometer atau adegan gaming --}}
                <img src="https://images.unsplash.com/photo-1593786267439-1b58872935c2?q=80&w=2072&auto=format&fit=crop" alt="Ilustrasi Tweak Performa" class="rounded-lg shadow-lg w-full h-auto object-cover">
            </div>
        </section>

        <hr class="my-16 border-gray-200">

        {{-- Manfaat Utama --}}
        <section class="reveal-on-scroll">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Manfaat Utama</h2>
                <p class="mt-2 text-gray-600">Peningkatan nyata yang akan Anda rasakan setiap hari.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">🎮</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Gaming & Multitasking Lancar</h3>
                        <p class="text-sm text-gray-600">Mengurangi lag, menstabilkan FPS, dan membuat perpindahan antar aplikasi lebih mulus.</p>
                    </div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">⚡️</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Responsivitas Sistem</h3>
                        <p class="text-sm text-gray-600">Membuka aplikasi, scrolling, dan navigasi antarmuka terasa jauh lebih cepat dan instan.</p>
                    </div>
                </div>
                 <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">🧠</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Manajemen Memori Efisien</h3>
                        <p class="text-sm text-gray-600">Menghapus aplikasi bawaan (bloatware) yang tidak perlu untuk melegakan RAM dan storage.</p>
                    </div>
                </div>
                 <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">🌡️</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Suhu Lebih Terjaga</h3>
                        <p class="text-sm text-gray-600">Menyesuaikan profil thermal agar perangkat tidak cepat panas saat digunakan secara intensif.</p>
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
                        <span>Apakah proses ini memerlukan akses root?</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div class="faq-content">
                        <p class="p-4 pt-0 text-gray-600">Beberapa level optimisasi yang sangat mendalam (seperti penyesuaian kernel) memerlukan akses root. Namun, kami juga menyediakan banyak opsi tweaking yang efektif dan aman tanpa memerlukan root.</p>
                    </div>
                </div>
                <div class="faq-item border border-gray-200 rounded-lg">
                    <button class="faq-question w-full text-left font-semibold cursor-pointer p-4 flex justify-between items-center gap-4">
                        <span>Apakah perubahan ini permanen dan aman?</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div class="faq-content">
                        <p class="p-4 pt-0 text-gray-600">Proses ini aman karena kami hanya mengubah parameter yang sudah teruji. Sebagian besar perubahan dapat dikembalikan ke pengaturan awal jika diperlukan, sehingga memberikan Anda fleksibilitas.</p>
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