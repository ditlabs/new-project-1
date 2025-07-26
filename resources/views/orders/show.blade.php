<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan Saya') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900 space-y-6">

                    <div>
                        <h3 class="font-semibold mb-4 text-2xl">Lacak Pesanan</h3>
                        <h3 class="font-semibold text-lg">Detail Pesanan #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h3>
                        <p>Status Saat Ini: <span class="font-bold text-green-600">{{ ucwords(str_replace('_', ' ', $order->status)) }}</span></p>
                    </div>

                    <div class="border-t pt-6">
                        <h3 class="font-semibold mb-4">Rincian Barang</h3>
                        @foreach ($order->details as $detail)
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/' . $detail->produk->gambar_produk) }}" alt="{{ $detail->produk->nama_produk }}" class="w-16 h-16 object-cover rounded-md mr-4">
                                    <div>
                                        <p class="font-semibold">{{ $detail->produk->nama_produk }}</p>
                                        <p class="text-sm text-gray-600">{{ $detail->quantity }} x Rp {{ number_format($detail->price) }}</p>
                                    </div>
                                </div>
                                <p class="font-semibold">Rp {{ number_format($detail->price * $detail->quantity) }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t pt-6 space-y-2">
                        <h3 class="font-semibold mb-4">Rincian Pembayaran</h3>
                        <div class="flex justify-between">
                            <p class="text-gray-600">Subtotal</p>
                            {{-- Menghitung subtotal dari total dikurangi ongkir (asumsi ongkir statis) --}}
                            <p class="font-semibold">Rp {{ number_format($order->total_price - 10000) }}</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-gray-600">Biaya Pengiriman</p>
                            <p class="font-semibold">Rp 10.000</p>
                        </div>
                        <div class="flex justify-between text-xl font-bold mt-2 pt-2 border-t">
                            <p>Total Pembayaran</p>
                            <p>Rp {{ number_format($order->total_price) }}</p>
                        </div>
                    </div>

                    {{-- Ganti blok "Unggah Bukti Pembayaran" di show.blade.php dengan ini --}}

                    <div class="border-t pt-6">

                        {{-- Kondisi 1: Tampilkan formulir JIKA statusnya "Belum Dikonfirmasi" DAN bukti belum pernah diunggah. --}}
                        @if ($order->status == 'Belum Dikonfirmasi' && !$order->payment_proof_path)
                            <h3 class="font-semibold mb-4 text-lg">Unggah Bukti Pembayaran</h3>
                            <p class="text-sm text-gray-600 mb-4">Silakan unggah bukti transfer Anda di sini. Format yang diterima adalah JPG, PNG, atau JPEG (maks. 2MB).</p>
                            
                            <form action="{{ route('pesanan.upload_bukti', $order) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="flex items-center gap-4">
                                    <input type="file" name="bukti_pembayaran" required class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"/>
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors whitespace-nowrap">Kirim</button>
                                </div>
                                @error('bukti_pembayaran')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </form>

                        {{-- Kondisi 2: Tampilkan pesan konfirmasi JIKA bukti SUDAH pernah diunggah. --}}
                        @elseif($order->payment_proof_path)
                            <h3 class="font-semibold mb-4 text-lg">Bukti Pembayaran Terkirim</h3>
                            <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-md" role="alert">
                                <p class="font-bold">Terima Kasih!</p>
                                <p>Bukti pembayaran Anda telah berhasil dikirim dan sedang menunggu verifikasi oleh tim kami.</p>
                            </div>
                        @endif

                    </div>

                    <div class="border-t pt-6">
                        <h3 class="font-semibold mb-2">Informasi Toko</h3>
                        <div class="mt-2 bg-gray-100 p-3 rounded-lg">
                            <p class="font-semibold">Ditlabs</p>
                            <p class="text-sm text-gray-600">Jalan Teknologi No. 123, Cibiru, Bandung, 40294</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>