<x-app-layout>
  
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

                        <div class="flex space-x-2 mt-4">
                            <a href="{{ route('produk.detail', $produk->id) }}" class="w-4/5">
                                <button class="w-full bg-green-600 hover:bg-indigo-800 text-white px-6 py-2 rounded-lg font-semibold">
                                    Detail Produk
                                </button>
                            </a>

                            <form class="add-to-cart-form">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-full bg-white border border-gray-600 hover:bg-gray-300 px-4 py-2 rounded-lg font-semibold flex items-center justify-center">
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

    <!-- Testimonials Section -->
    <x-testimonials/>

    {{-- Footer --}}
    <x-footer/>
    
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Logika untuk semua tombol "Tambah ke Keranjang" di halaman ini ---
            const addToCartForms = document.querySelectorAll('.add-to-cart-form');

            addToCartForms.forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();

                    const formData = new FormData(this);

                    fetch('{{ route("keranjang.add") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            // Mengirim sinyal agar badge di navigasi terupdate
                            document.dispatchEvent(new Event('cartUpdated'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan, silakan coba lagi!',
                        });
                    });
                });
            });
        });
    </script>
    @endpush
</x-app-layout>