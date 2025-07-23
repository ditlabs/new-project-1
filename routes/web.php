<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/layanan/{slug}', function ($slug) {
    // ===================================================================
    // DATA LENGKAP UNTUK SEMUA LAYANAN
    // Di aplikasi nyata, data ini sebaiknya datang dari Database.
    // ===================================================================
    $services = [
        'custom-rom-installation' => [
            'slug' => 'custom-rom-installation',
            'title' => 'Layanan Instalasi Custom ROM',
            'subtitle' => 'Buka Potensi Sebenarnya dari Perangkat Android Anda.',
            'overview' => 'Custom ROM adalah versi Android yang dimodifikasi untuk memberikan performa, baterai, dan fitur yang lebih baik. Di Ditlabs, kami membantu Anda memilih dan menginstal ROM yang paling stabil dan sesuai kebutuhan Anda, mengubah perangkat lama menjadi terasa baru kembali.',
            'image_url' => 'https://images.unsplash.com/photo-1611791485440-24e5246b8405?q=80&w=800',
            'benefits' => [
                ['icon' => '🚀', 'title' => 'Peningkatan Performa', 'description' => 'Tanpa bloatware, perangkat Anda berjalan lebih cepat, lancar, dan responsif.'],
                ['icon' => '🔋', 'title' => 'Baterai Lebih Awet', 'description' => 'ROM yang dioptimalkan untuk konsumsi daya yang lebih efisien, memberikan jam penggunaan ekstra.'],
                ['icon' => '✨', 'title' => 'Fitur & Kustomisasi', 'description' => 'Dapatkan versi Android terbaru dan ubah hampir semua aspek visual sesuka Anda.'],
                ['icon' => '🛡️', 'title' => 'Kontrol Privasi', 'description' => 'Banyak Custom ROM berfokus pada privasi, memberikan Anda kontrol lebih besar atas data.'],
            ],
            'process' => [
                ['step' => '1', 'title' => 'Konsultasi & Pemeriksaan', 'description' => 'Kami menganalisis model perangkat Anda dan merekomendasikan Custom ROM yang kompatibel.'],
                ['step' => '2', 'title' => 'Backup Data Penuh', 'description' => 'Keamanan data Anda adalah prioritas. Kami mencadangkan seluruh data penting Anda.'],
                ['step' => '3', 'title' => 'Unlock & Instalasi Recovery', 'description' => 'Melakukan langkah teknis awal dengan aman, seperti membuka bootloader dan memasang TWRP.'],
                ['step' => '4', 'title' => 'Instalasi & Konfigurasi ROM', 'description' => 'Kami menginstal ROM pilihan Anda dan memastikan semua fungsi dasar berjalan sempurna.'],
            ],
            'faqs' => [
                ['question' => 'Apakah proses ini aman untuk ponsel saya?', 'answer' => 'Sangat aman. Tim kami terdiri dari teknisi berpengalaman yang mengikuti praktik terbaik industri untuk meminimalkan semua risiko.'],
                ['question' => 'Apakah saya akan kehilangan data saya?', 'answer' => 'Tidak, kami melakukan pencadangan data lengkap sebelum proses instalasi dan mengembalikannya setelah selesai.'],
                ['question' => 'Apakah ini akan menghilangkan garansi resmi?', 'answer' => 'Membuka bootloader umumnya dapat membatalkan garansi dari produsen. Kami akan menjelaskan semua implikasinya kepada Anda.'],
            ],
        ],
        'tweaking-performance' => [
            'slug' => 'tweaking-performance',
            'title' => 'Layanan Tweaking Performance',
            'subtitle' => 'Optimalkan kecepatan dan efisiensi perangkat Anda untuk kebutuhan maksimal.',
            'overview' => 'Jika Anda merasa perangkat sudah cukup baik namun belum maksimal, layanan tweaking kami adalah solusinya. Kami melakukan optimisasi mendalam pada sistem Anda tanpa mengubah OS, termasuk debloating, pengaturan kernel, dan penyesuaian CPU/GPU untuk gaming dan multitasking yang lebih lancar.',
            'image_url' => 'https://images.unsplash.com/photo-1593786267439-1b58872935c2?q=80&w=800',
            'benefits' => [
                ['icon' => '🎮', 'title' => 'Gaming Lebih Lancar', 'description' => 'Mengurangi stutter dan meningkatkan FPS pada game favorit Anda.'],
                ['icon' => '⚡', 'title' => 'Responsivitas UI', 'description' => 'Navigasi antarmuka, membuka aplikasi, dan multitasking terasa lebih cepat.'],
                ['icon' => '🗑️', 'title' => 'Debloating', 'description' => 'Menghapus aplikasi bawaan yang tidak perlu untuk melegakan RAM dan storage.'],
                ['icon' => '🌡️', 'title' => 'Manajemen Suhu', 'description' => 'Menyesuaikan profil thermal agar perangkat tidak cepat panas saat digunakan.'],
            ],
            'process' => [
                ['step' => '1', 'title' => 'Analisis Performa Awal', 'description' => 'Kami melakukan benchmark dan menganalisis penggunaan Anda untuk menentukan area optimisasi.'],
                ['step' => '2', 'title' => 'Debloating & Pembersihan', 'description' => 'Menghapus aplikasi dan layanan latar belakang yang memberatkan sistem.'],
                ['step' => '3', 'title' => 'Penyesuaian Kernel & CPU', 'description' => 'Mengatur governor CPU dan parameter kernel lainnya untuk keseimbangan performa dan daya.'],
                ['step' => '4', 'title' => 'Pengujian Stabilitas', 'description' => 'Memastikan semua perubahan berjalan stabil dan memberikan hasil yang diinginkan.'],
            ],
            'faqs' => [
                ['question' => 'Apakah ini membutuhkan root?', 'answer' => 'Beberapa level tweaking mendalam mungkin memerlukan akses root, namun kami juga menyediakan opsi optimisasi yang aman tanpa root.'],
                ['question' => 'Apakah perubahan ini permanen?', 'answer' => 'Sebagian besar perubahan dapat dikembalikan ke pengaturan awal jika Anda menginginkannya.'],
            ],
        ],
        'root-unlock' => [
            'slug' => 'root-unlock',
            'title' => 'Layanan Root & Unlock',
            'subtitle' => 'Dapatkan akses administratif penuh atas sistem operasi Android Anda.',
            'overview' => 'Rooting adalah proses untuk mendapatkan kontrol tertinggi (dikenal sebagai "root access" atau "Superuser") atas perangkat Android Anda. Ini memungkinkan Anda untuk memodifikasi file sistem, menginstal aplikasi khusus yang memerlukan izin lebih, dan menghapus batasan yang ditetapkan oleh produsen.',
            'image_url' => 'https://images.unsplash.com/photo-1605146769289-424c3d194589?q=80&w=800',
            'benefits' => [
                ['icon' => '🔧', 'title' => 'Modifikasi Tanpa Batas', 'description' => 'Menginstal framework seperti Xposed atau Magisk untuk modul kustomisasi tingkat lanjut.'],
                ['icon' => '🚫', 'title' => 'Hapus Iklan Sistem', 'description' => 'Memblokir iklan secara menyeluruh di semua aplikasi dan browser.'],
                ['icon' => '💾', 'title' => 'Backup Total', 'description' => 'Melakukan backup seluruh partisi sistem dengan aplikasi seperti Titanium Backup.'],
                ['icon' => '⚙️', 'title' => 'Aplikasi Powerfull', 'description' => 'Menjalankan aplikasi khusus untuk firewall, otomatisasi, dan tweaking mendalam.'],
            ],
            'process' => [
                ['step' => '1', 'title' => 'Pemeriksaan Kompatibilitas', 'description' => 'Memastikan perangkat dan versi Android Anda memiliki metode root yang aman dan teruji.'],
                ['step' => '2', 'title' => 'Unlock Bootloader', 'description' => 'Langkah pertama yang esensial, membuka kunci bootloader perangkat.'],
                ['step' => '3', 'title' => 'Flashing & Patching', 'description' => 'Menginstal file yang diperlukan (seperti Magisk) untuk mendapatkan akses root.'],
                ['step' => '4', 'title' => 'Verifikasi & Instalasi', 'description' => 'Memastikan akses root berfungsi dengan benar dan menginstal aplikasi Superuser.'],
            ],
            'faqs' => [
                ['question' => 'Apa risiko dari rooting?', 'answer' => 'Risiko utamanya adalah potensi masalah keamanan jika izin root diberikan ke aplikasi yang tidak terpercaya dan pembatalan garansi. Kami menggunakan metode paling aman untuk meminimalkan risiko teknis.'],
                ['question' => 'Bisakah proses root di-unroot?', 'answer' => 'Ya, sebagian besar metode modern seperti Magisk memungkinkan proses unroot yang mudah dan bersih.'],
            ],
        ],
        'unlock-bootloader' => [
            'slug' => 'unlock-bootloader',
            'title' => 'Layanan Unlock Bootloader',
            'subtitle' => 'Buka kunci bootloader untuk akses penuh ke perangkat Anda.',
            'overview' => 'Unlock bootloader adalah langkah pertama untuk mendapatkan kontrol penuh atas perangkat Android Anda. Ini memungkinkan instalasi Custom ROM, rooting, dan modifikasi sistem lainnya. Kami membantu Anda membuka kunci bootloader dengan aman dan efisien.',
            'image_url' => 'https://images.unsplash.com/photo-1605146769289-424c3d194589?q=80&w=800',
            'benefits' => [
                ['icon' => '🔓', 'title' => 'Akses Penuh', 'description' => 'Dapatkan kontrol penuh atas sistem operasi Android Anda.'],
                ['icon' => '⚙️', 'title' => 'Modifikasi Sistem', 'description' => 'Instal Custom ROM, kernel, dan modifikasi lainnya.'],
                ['icon' => '🔧', 'title' => 'Kustomisasi Mendalam', 'description' => 'Ubah hampir semua aspek perangkat Anda sesuai keinginan.'],
                ['icon' => '🚀', 'title' => 'Performa Lebih Baik', 'description' => 'Optimalkan performa dengan menginstal ROM yang lebih ringan dan cepat.'],
            ],
            'process' => [
                ['step' => '1', 'title' => 'Pemeriksaan Perangkat', 'description' => 'Kami memeriksa kompatibilitas perangkat Anda untuk memastikan proses unlock berjalan lancar.'],
                ['step' => '2', 'title' => 'Backup Data Penting', 'description' => 'Sebelum membuka kunci, kami melakukan backup data penting untuk menghindari kehilangan informasi.'],
                ['step' => '3', 'title' => 'Proses Unlock Bootloader', 'description' => 'Menggunakan metode resmi dari produsen untuk membuka kunci bootloader dengan aman.'],
                ['step' => '4', 'title' => 'Verifikasi & Pengaturan Awal', 'description' => 'Memastikan bootloader telah terbuka dan perangkat siap untuk modifikasi lebih lanjut.'],
            ],
            'faqs' => [
                ['question' => 'Apakah membuka kunci bootloader membatalkan garansi?', 'answer' => 'Ya, membuka kunci bootloader umumnya membatalkan garansi resmi dari produsen. Namun, kami akan menjelaskan semua implikasinya sebelum melanjutkan.'],
                ['question' => 'Apakah proses ini aman?', 'answer' => 'Kami mengikuti prosedur yang aman dan teruji untuk membuka kunci bootloader, meminimalkan risiko kerusakan perangkat.'],
            ],
        ],
        'upgrade-downgrade' => [
            'slug' => 'upgrade-downgrade',
            'title' => 'Layanan Upgrade & Downgrade',
            'subtitle' => 'Perbarui atau turunkan versi Android Anda dengan aman.',
            'overview' => 'Apakah Anda ingin mencoba versi Android terbaru atau kembali ke versi sebelumnya? Kami menyediakan layanan upgrade dan downgrade yang aman, memastikan perangkat Anda tetap stabil dan data Anda aman. Kami membantu Anda memilih versi yang paling sesuai dengan kebutuhan Anda.',
            'image_url' => 'https://images.unsplash.com/photo-1605146769289-424c3d194589?q=80&w=800',
            'benefits' => [
                ['icon' => '⬆️', 'title' => 'Upgrade ke Versi Terbaru', 'description' => 'Nikmati fitur dan peningkatan performa dari versi Android terbaru.'],
                ['icon' => '⬇️', 'title' => 'Downgrade ke Versi Stabil', 'description' => 'Kembali ke versi Android yang lebih stabil jika Anda mengalami masalah dengan versi terbaru.'],
                ['icon' => '🔄', 'title' => 'Kustomisasi Versi', 'description' => 'Pilih versi Android yang paling sesuai dengan kebutuhan dan preferensi Anda.'],
                ['icon' => '🛡️', 'title' => 'Keamanan Data', 'description' => 'Kami melakukan backup data lengkap sebelum proses upgrade atau downgrade untuk menghindari kehilangan informasi.'],
            ],
            'process' => [
                ['step' => '1', 'title' => 'Konsultasi Versi', 'description' => 'Kami membantu Anda memilih versi Android yang paling sesuai dengan kebutuhan Anda.'],
                ['step' => '2', 'title' => 'Backup Data Penuh', 'description' => 'Melakukan backup data penting Anda untuk menghindari kehilangan informasi.'],
                ['step' => '3', 'title' => 'Proses Upgrade/Downgrade', 'description' => 'Menginstal versi Android yang dipilih dengan aman dan efisien.'],
                ['step' => '4', 'title' => 'Verifikasi & Pengaturan Awal', 'description' => 'Memastikan perangkat berfungsi dengan baik setelah upgrade atau downgrade.'],
            ],
            'faqs' => [
                ['question' => 'Apakah proses ini aman?', 'answer' => 'Ya, kami mengikuti prosedur yang aman dan teruji untuk memastikan perangkat Anda tetap stabil selama proses upgrade atau downgrade.'],
                ['question' => 'Apakah saya akan kehilangan data saya?', 'answer' => 'Tidak, kami melakukan backup data lengkap sebelum proses upgrade atau downgrade untuk menghindari kehilangan informasi.'],
            ],
        ],
        'consultation-support' => [
            'slug' => 'consultation-support',
            'title' => 'Layanan Konsultasi & Dukungan',
            'subtitle' => 'Butuh bantuan? Kami siap membantu Anda.',
            'overview' => 'Kami menyediakan layanan konsultasi dan dukungan untuk semua masalah terkait Android. Apakah Anda memiliki pertanyaan tentang perangkat Anda, ingin tahu cara mengoptimalkan kinerja, atau butuh bantuan dengan instalasi Custom ROM? Tim kami siap membantu Anda dengan solusi yang tepat.',
            'image_url' => 'https://images.unsplash.com/photo-1605146769289-424c3d194589?q=80&w=800',
            'benefits' => [
                ['icon' => '💬', 'title' => 'Konsultasi Ahli', 'description' => 'Dapatkan saran dari teknisi berpengalaman tentang masalah perangkat Anda.'],
                ['icon' => '🛠️', 'title' => 'Dukungan Teknis', 'description' => 'Kami siap membantu Anda dengan masalah teknis apa pun yang Anda hadapi.'],
                ['icon' => '📞', 'title' => 'Bantuan Jarak Jauh', 'description' => 'Kami dapat memberikan dukungan jarak jauh untuk menyelesaikan masalah perangkat Anda.'],
            ],
            'process' => [
                ['step' => '1', 'title' => 'Konsultasi Awal', 'description' => 'Kami mendengarkan masalah Anda dan memberikan saran awal.'],
                ['step' => '2', 'title' => 'Analisis Masalah', 'description' => 'Kami menganalisis masalah perangkat Anda untuk menentukan solusi terbaik.'],
                ['step' => '3', 'title' => 'Pemberian Solusi', 'description' => 'Kami memberikan solusi yang tepat untuk masalah yang Anda hadapi.'],
                ['step' => '4', 'title' => 'Dukungan Lanjutan', 'description' => 'Jika diperlukan, kami menyediakan dukungan lanjutan untuk memastikan masalah teratasi.'],
            ],
            'faqs' => [
                ['question' => 'Apakah layanan ini gratis?', 'answer' => 'Layanan konsultasi awal gratis, namun ada biaya untuk dukungan teknis lebih lanjut tergantung pada kompleksitas masalah.'],
                ['question' => 'Bagaimana cara menghubungi tim dukungan?', 'answer' => 'Anda dapat menghubungi kami melalui formulir kontak di situs web kami atau melalui email. Kami akan merespons secepatnya.'],
            ],
        ],
    ];

    // Jika slug tidak ditemukan, tampilkan halaman 404
    if (!array_key_exists($slug, $services)) {
        abort(404);
    }

    $service = $services[$slug];

    return view('layanan-detail', ['service' => $service]);

})->name('layanan.show');

