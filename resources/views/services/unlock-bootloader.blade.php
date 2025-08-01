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
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900">Layanan Unlock Bootloader</h1>
            <p class="mt-4 text-lg text-gray-600">Langkah pertama dan paling fundamental untuk membuka kebebasan modifikasi Android Anda.</p>
        </header>

        <hr class="my-16 border-gray-200">

        {{-- Deskripsi Layanan --}}
        <section class="flex flex-col md:flex-row items-center gap-12 reveal-on-scroll">
            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold mb-4 text-gray-900">Deskripsi Layanan</h2>
                <p class="text-gray-700 leading-relaxed">Bootloader adalah program pertama yang berjalan saat perangkat Anda menyala, berfungsi sebagai "penjaga gerbang" sistem. Layanan ini secara aman membuka kunci tersebut, yang merupakan syarat wajib sebelum Anda dapat menginstal Custom ROM, Custom Recovery (TWRP), atau mendapatkan akses root.</p>
            </div>
            <div class="md:w-1/2">
                <img src="{{ asset('storage/Unlock Bootloader.png') }}" alt="Ilustrasi Unlock Bootloader" class="rounded-lg shadow-lg w-full h-auto object-cover">
            </div>
        </section>

        <hr class="my-16 border-gray-200">

        {{-- Manfaat Utama --}}
        <section class="reveal-on-scroll">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Manfaat Utama</h2>
                <p class="mt-2 text-gray-600">Membuka pintu untuk semua kemungkinan modifikasi.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">🔓</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Gerbang Modifikasi</h3>
                        <p class="text-sm text-gray-600">Membuka akses untuk menginstal Custom ROM, Custom Kernel, dan Custom Recovery (TWRP).</p>
                    </div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">🛠️</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Kontrol Penuh Developer</h3>
                        <p class="text-sm text-gray-600">Memberikan Anda kontrol tingkat developer atas partisi sistem perangkat Anda.</p>
                    </div>
                </div>
                 <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">📈</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Fleksibilitas Sistem Operasi</h3>
                        <p class="text-sm text-gray-600">Memungkinkan instalasi sistem operasi yang berbeda dari bawaan pabrik di masa mendatang.</p>
                    </div>
                </div>
                 <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-start gap-4">
                    <div class="text-3xl mt-1">🧪</div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Akses Uji Coba Lanjutan</h3>
                        <p class="text-sm text-gray-600">Sangat esensial bagi developer atau antusias yang ingin menguji software tingkat rendah.</p>
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
                        <span>Apakah unlock bootloader akan menghapus data saya?</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div class="faq-content">
                        <p class="p-4 pt-0 text-gray-600">Ya, pada sebagian besar perangkat, proses ini akan memicu 'factory reset' dan menghapus semua data internal. Karena itu, melakukan backup penuh adalah langkah pertama yang selalu kami lakukan.</p>
                    </div>
                </div>
                <div class="faq-item border border-gray-200 rounded-lg">
                    <button class="faq-question w-full text-left font-semibold cursor-pointer p-4 flex justify-between items-center gap-4">
                        <span>Apakah ini sama dengan 'root'?</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div class="faq-content">
                        <p class="p-4 pt-0 text-gray-600">Tidak. Unlock bootloader adalah pra-syarat atau langkah yang diperlukan *sebelum* melakukan rooting. Proses ini sendiri tidak memberikan akses root, tetapi membuka jalan untuknya.</p>
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