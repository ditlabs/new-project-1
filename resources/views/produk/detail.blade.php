<x-app-layout>
    <div class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <!-- Gambar Produk -->
                <div>
                    <div class="relative w-full h-[400px] sm:h-[500px] bg-white rounded-xl overflow-hidden shadow-lg">
                        <img 
                            src="{{ url('storage/' . $produk->gambar_produk) }}" 
                            alt="{{ $produk->nama_produk }}" 
                            class="w-full h-full object-cover object-center transition duration-300 ease-in-out hover:scale-105"
                        />
                    </div>
                </div>

                <!-- Informasi Produk -->
                <div>
                    <h1 class="text-4xl font-extrabold text-gray-900">{{ $produk->nama_produk }}</h1>
                    <p class="mt-4 text-gray-600 text-lg leading-relaxed">{{ $produk->deskripsi_produk }}</p>
                    
                    <div class="mt-6">
                        <span class="text-2xl text-green-600 font-bold">Rp {{ number_format($produk->harga_produk) }}</span>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <form action="#" method="POST" class="w-full sm:w-auto">
                            @csrf
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow transition">
                                Beli Sekarang
                            </button>
                        </form>

                        <a href="{{ url()->previous() }}" class="w-full sm:w-auto">
                            <button class="w-full border border-gray-400 hover:bg-gray-100 text-gray-800 px-6 py-3 rounded-lg text-lg font-medium transition">
                                Kembali
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
