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
                        <h3 class="font-semibold text-lg">Detail Pesanan #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                        </h3>
                        <p>Status Saat Ini:
                            <span class="font-bold
                                @if($order->status == 'selesai') text-green-600
                                @elseif($order->status == 'dibatalkan') text-red-600
                                @else text-blue-600 @endif">
                                {{ ucwords(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </p>
                    </div>

                    <div class="border-t pt-6">
                        <h3 class="font-semibold mb-4">Rincian Barang</h3>
                        @foreach ($order->details as $detail)
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/' . $detail->produk->gambar_produk) }}"
                                        alt="{{ $detail->produk->nama_produk }}"
                                        class="w-16 h-16 object-cover rounded-md mr-4">
                                    <div>
                                        <p class="font-semibold">{{ $detail->produk->nama_produk }}</p>
                                        <p class="text-sm text-gray-600">{{ $detail->quantity }} x Rp
                                            {{ number_format($detail->price) }}</p>
                                    </div>
                                </div>
                                <p class="font-semibold">Rp {{ number_format($detail->price * $detail->quantity) }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t pt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-semibold mb-2">Alamat Pengiriman</h3>
                            <div class="text-sm text-gray-600 leading-relaxed">
                                {!! nl2br(e($order->shipping_address ?? 'Alamat tidak tersedia.')) !!}
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-2">Informasi Pengirim</h3>
                            <div class="text-sm text-gray-600 leading-relaxed">
                                <strong>Ditlabs</strong><br>
                                Jalan Teknologi No. 123, Cibiru<br>
                                Bandung, 40294
                            </div>
                        </div>
                    </div>

@if ($order->status == 'diproses' || $order->status == 'selesai')
    <div class="border-t pt-6">
        <h3 class="font-semibold mb-2">Lacak Pengiriman</h3>

        @if ($order->tracking_number)
            <p class="text-sm text-gray-600">Nomor Resi Anda:</p>
            <p class="font-mono text-lg font-bold text-indigo-600 bg-gray-100 p-2 rounded-md mt-1">
                {{ $order->tracking_number }}
            </p>
        
                            @elseif ($order->status == 'diproses')
                                <p class="text-sm text-gray-600 mb-2">Silakan masukkan nomor resi pengiriman Anda di bawah ini.</p>
                                <form action="{{ route('pesanan.add_resi', $order) }}" method="POST">
                                    @csrf
                                    @method('PATCH') 
                                    <div class="flex items-center gap-4">
                                        <input type="text" name="tracking_number" required
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                                            placeholder="Masukkan nomor resi...">
                                        <button type="submit"
                                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors whitespace-nowrap">
                                            Simpan
                                        </button>
                                    </div>
                                    @error('tracking_number')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </form>
                            @endif
                        </div>
                    @endif

                    <div class="border-t pt-6 space-y-2">
                        <h3 class="font-semibold mb-4">Rincian Pembayaran</h3>
                        <div class="flex justify-between">
                            <p class="text-gray-600">Subtotal</p>
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

                    @if ($order->status == 'belum_dikonfirmasi' && !$order->payment_proof_path)
                        <div class="border-t pt-6">
                            <h3 class="font-semibold mb-4 text-lg">Unggah Bukti Pembayaran</h3>
                            <p class="text-sm text-gray-600 mb-4">Silakan unggah bukti transfer Anda di sini. Format
                                yang diterima adalah JPG, PNG, atau JPEG (maks. 2MB).</p>
                            <form action="{{ route('pesanan.upload_bukti', $order) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="flex items-center gap-4">
                                    <input type="file" name="bukti_pembayaran" required
                                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
                                    <button type="submit"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors whitespace-nowrap">Kirim</button>
                                </div>
                                @error('bukti_pembayaran')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </form>
                        </div>

                    @elseif ($order->payment_proof_path && $order->status != 'selesai' && $order->status != 'dibatalkan')
                        <div class="border-t pt-6">
                             <h3 class="font-semibold mb-4 text-lg">Bukti Pembayaran Terkirim</h3>
                             <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-md"
                                 role="alert">
                                 <p class="font-bold">Terima Kasih!</p>
                                 <p>Bukti pembayaran Anda telah berhasil dikirim dan sedang menunggu verifikasi.
                                 </p>
                             </div>
                        </div>

                    @elseif ($order->status == 'selesai')
                        <div class="border-t pt-6">
                            <h3 class="font-semibold text-lg mb-4">Beri Ulasan untuk Produk Anda</h3>
                            @foreach ($order->details as $detail)
                                <div class="bg-gray-50 p-4 rounded-lg mb-4">
                                    <p class="font-semibold mb-2">{{ $detail->produk->nama_produk }}</p>
                                    @php
                                        $existingReview = App\Models\Testimonial::where('user_id', auth()->id())
                                                            ->where('produk_id', $detail->produk_id)
                                                            ->first();
                                    @endphp
                                    @if ($existingReview)
                                        <p class="text-sm text-gray-700">Anda sudah memberikan ulasan untuk produk ini.
                                        </p>
                                    @else
                                        <form action="{{ route('review.store', $detail->produk_id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <div class="mb-2">
                                                <div class="flex flex-row-reverse justify-end items-center space-x-1 space-x-reverse mt-1">
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <input type="radio" id="rating-{{ $detail->id }}-{{ $i }}" name="rating" value="{{ $i }}" class="sr-only peer" required>
                                                        <label for="rating-{{ $detail->id }}-{{ $i }}" class="cursor-pointer text-2xl text-gray-300 peer-hover:text-yellow-400 peer-checked:text-yellow-500 peer-checked:peer-hover:text-yellow-500">★</label>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <textarea name="comment" rows="2" placeholder="Tulis ulasan Anda (opsional)..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"></textarea>
                                            </div>
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-2 px-4 rounded-lg">Kirim Ulasan</button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="border-t pt-6">
                        <h3 class="font-semibold mb-2">Informasi Toko</h3>
                        <div class="mt-2 bg-gray-100 p-3 rounded-lg">
                            <p class="font-semibold">Ditlabs</p>
                            <p class="text-sm text-gray-600">Jalan Teknologi No. 123, Cibiru, Bandung, 40294</p>
                        </div>
                    </div>

                    @if ($order->status == 'belum_dikonfirmasi' && !$order->payment_proof_path)
                        <div class="border-t pt-6 text-center">
                             <form action="{{ route('pesanan.batal', $order) }}" method="POST">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit"
                                         onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')"
                                         class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                                     Batalkan Pesanan
                                 </button>
                             </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
