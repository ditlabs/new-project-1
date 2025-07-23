<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<!-- Hero Section -->
    <x-hero/>

      <div class="mx-auto py-32 container">
            <h1 class="text-3xl sm:text-4xl font-semibold">Mau nyari apa?</h1>
            <p class="text-lg mb-8">Berikut list produk yang kami jual di toko kami!</p>
                  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                      @foreach ($produks as $produk)
                      <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img
                          class="w-full h-60 sm:h-72 md:h-80 lg:h-96 object-cover object-center"
                          src="{{ url('storage/' . $produk->gambar_produk) }}"
                          alt="{{ $produk->nama_produk }}"
                      />

                      <div class="p-4">
                          <p class="text-2xl font-medium">{{ $produk->nama_produk }}</p>
                          <p class="text-gray-500 font-semibold mt-1">Rp. {{ number_format($produk->harga_produk) }}</p>

                          <!-- Container untuk Tombol -->
                          <div class="flex space-x-2 mt-4">
                              <!-- Tombol "Buy Now" -->
                              <a href="{{ route('produk.detail', $produk->id) }}" class="w-4/5">
                                  <button class="w-full bg-green-600 hover:bg-indigo-800 text-white px-6 py-2 rounded-lg font-semibold">
                                      Detail Produk
                                  </button>
                              </a>


                        <!-- Tombol "Keranjang" -->
                        <form action=" ">
                          @csrf
                            <button type="submit" class="w-full bg-white border border-gray-600 hover:bg-gray-300  px-4 py-2 rounded-lg font-semibold flex items-center justify-center">
                                <img src="https://cdn-icons-png.flaticon.com/128/3144/3144456.png" 
                                    class="block h-6 w-auto" 
                                    alt="Keranjang">
                            </button>
                          </form>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
      </div>
</x-app-layout>
