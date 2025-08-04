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
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900">Layanan Root & Unlock</h1>
            <p class="mt-4 text-lg text-gray-600">Dapatkan akses administratif penuh (Superuser) untuk kontrol tanpa batas atas perangkat Android Anda.</p>
        </header>

        <hr class="my-16 border-gray-200">

        {{-- Deskripsi Layanan --}}
        <section class="flex flex-col md:flex-row items-center gap-12 reveal-on-scroll">
            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold mb-4 text-gray-900">Deskripsi Layanan</h2>
                <p class="text-gray-700 leading-relaxed">Rooting adalah proses untuk mendapatkan hak akses tertinggi pada sistem Android Anda. Ini seperti menjadi "administrator" di perangkat Anda sendiri, memungkinkan Anda melewati batasan pabrikan, memodifikasi file sistem, dan menjalankan aplikasi canggih yang memerlukan izin khusus.</p>
            </div>
            <div class="md:w-1/2">
                <img src="https://raw.githubusercontent.com/ditlabs/image-project-1/refs/heads/main/services/root-magisk.jpg" alt="Ilustrasi Root Android" class="rounded-lg shadow-lg w-full h-auto object-cover">
            </div>
        </section>

        <hr class="my-16 border-gray-200">

        {{-- Manfaat Utama --}}
        <section class="reveal-on-scroll">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Manfaat Utama</h2>
                <p class="mt-2 text-gray-600">Kekuatan dan kontrol yang bisa Anda dapatkan.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">🔧</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Modifikasi Tanpa Batas</h3>
                        <p class="text-sm text-gray-600">Menginstal framework seperti Magisk atau Xposed untuk kustomisasi tingkat lanjut yang mustahil dilakukan sebelumnya.</p>
                    </div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">🗑️</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Hapus Bloatware Total</h3>
                        <p class="text-sm text-gray-600">Menghapus aplikasi bawaan pabrik yang tidak diinginkan secara permanen untuk melegakan memori.</p>
                    </div>
                </div>
                 <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">💾</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Backup & Restore Menyeluruh</h3>
                        <p class="text-sm text-gray-600">Lakukan backup seluruh sistem, termasuk data aplikasi, dengan alat canggih seperti Titanium Backup.</p>
                    </div>
                </div>
                 <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">⚙️</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Akses Aplikasi Eksklusif</h3>
                        <p class="text-sm text-gray-600">Menjalankan aplikasi canggih yang memerlukan izin root untuk firewall, otomatisasi, dan tweaking mendalam.</p>
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
                        <span>Apa risiko terbesar dari melakukan root?</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div class="faq-content">
                        <p class="p-4 pt-0 text-gray-600">Risiko utama ada dua: potensi celah keamanan jika Anda memberikan izin root ke aplikasi yang tidak terpercaya, dan hilangnya garansi resmi dari produsen. Kami akan memandu Anda untuk memitigasi risiko ini.</p>
                    </div>
                </div>
                <div class="faq-item border border-gray-200 rounded-lg">
                    <button class="faq-question w-full text-left font-semibold cursor-pointer p-4 flex justify-between items-center gap-4">
                        <span>Apakah proses root bisa dibatalkan (unroot)?</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div class="faq-content">
                        <p class="p-4 pt-0 text-gray-600">Ya. Dengan metode modern seperti Magisk, proses root sepenuhnya dapat dibatalkan (unroot). Anda bahkan dapat menyembunyikan status root dari aplikasi tertentu (seperti aplikasi perbankan) agar tetap berfungsi normal.</p>
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