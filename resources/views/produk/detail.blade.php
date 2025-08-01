<x-app-layout>
    <div class="bg-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">

                <div class="px-4">
                    <div class="w-[410px] h-[450px] bg-gray-100 rounded-xl shadow-lg overflow-hidden">
                        <img class="w-full h-full object-cover" src="{{ url('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}">
                    </div>
                </div>
                
                <div class="px-4">
                    <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $produk->nama_produk }}</h1>

                    <div class="flex items-center space-x-2 mt-3">
                        <div class="flex items-center">
                            <span class="text-yellow-400">★★★★☆</span>
                        </div>
                        <span class="text-sm text-gray-500">(12 ulasan)</span>
                    </div>
                    <p class="text-4xl font-semibold text-green-600 mt-6">
                        Rp. {{ number_format($produk->harga_produk, 0, ',', '.') }}
                    </p>
                    
                    <p class="text-gray-600 text-base mt-6">{{ $produk->deskripsi_produk }}</p>

                    <div class="mt-8">
                        <span class="font-bold text-gray-700">Kuantitas:</span>
                        <div class="flex items-center mt-2">
                            <button id="btn-minus" class="text-gray-600 bg-gray-200 rounded-l-lg px-4 py-2 hover:bg-gray-300 transition-colors">-</button>
                            <input id="quantity-input" class="w-16 text-center font-bold bg-gray-100 border-t border-b border-gray-200" type="text" value="1" readonly>
                            <button id="btn-plus" class="text-gray-600 bg-gray-200 rounded-r-lg px-4 py-2 hover:bg-gray-300 transition-colors">+</button>
                        </div>
                    </div>
                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button id="buy-now-btn" class="w-full bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow-md hover:shadow-lg transition">
                            Beli Sekarang
                        </button>
                        <form id="add-to-cart-form" class="w-full">
                            @csrf
                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                            <button type="submit" class="w-full border border-gray-400 hover:bg-gray-100 text-gray-800 px-6 py-3 rounded-lg text-lg font-medium transition">
                                + Keranjang
                            </button>
                        </form>
                    </div>
                    </div>
            </div>

            <div class="mt-16" x-data="{ openTab: 'spesifikasi' }">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button @click="openTab = 'spesifikasi'" :class="openTab === 'spesifikasi' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Spesifikasi
                        </button>
                        <button @click="openTab = 'pengiriman'" :class="openTab === 'pengiriman' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Info Pengiriman
                        </button>
                    </nav>
                </div>
                <div class="py-6">
                    <div x-show="openTab === 'spesifikasi'" class="prose max-w-none">
                            {!! $produk->spesifikasi !!}
                    </div>
                    <div x-show="openTab === 'pengiriman'" class="prose max-w-none">
                            {!! $produk->info_pengiriman !!}
                    </div>
                </div>
            </div>
            </div>
    </div>

    @push('scripts')
        {{-- Script fungsionalitas tombol tidak berubah --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Deklarasi Elemen
                const quantityInput = document.getElementById('quantity-input');
                const btnPlus = document.getElementById('btn-plus');
                const btnMinus = document.getElementById('btn-minus');
                const buyNowBtn = document.getElementById('buy-now-btn');
                const addToCartForm = document.getElementById('add-to-cart-form');

                // Listener Kuantitas
                btnPlus.addEventListener('click', () => { /* ... */ });
                btnMinus.addEventListener('click', () => { /* ... */ });

                // Listener "Tambah ke Keranjang"
                addToCartForm.addEventListener('submit', function (event) { 
                    event.preventDefault();
                    // ... (logika fetch untuk tambah ke keranjang)
                });

                // Listener "Beli Sekarang"
                buyNowBtn.addEventListener('click', function() {
                    const produkId = '{{ $produk->id }}';
                    const quantity = quantityInput.value;
                    const url = `{{ route('checkout.index') }}?produk_id=${produkId}&quantity=${quantity}`;
                    window.location.href = url;
                });
            });
        </script>
    @endpush
</x-app-layout>