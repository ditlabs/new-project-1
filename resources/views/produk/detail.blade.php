<x-app-layout>
    <div class="bg-gray-100 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col">
                
                <div class="px-4">
                    <div class="rounded-lg bg-gray-300 shadow-lg mb-4">
                        <img class="w-full h-full object-cover rounded-lg" src="{{ url('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}">
                    </div>
                </div>
                
                <div class="px-4">
                    <h2 class="text-4xl font-bold text-gray-800 mb-2">{{ $produk->nama_produk }}</h2>
                    <p class="text-gray-600 text-base mb-6">{{ $produk->deskripsi_produk }}</p>
                    <div class="flex items-center mb-6">
                        <span class="text-4xl font-bold text-indigo-600">Rp. {{ number_format($produk->harga_produk, 0, ',', '.') }}</span>
                    </div>

                    <div class="mb-6">
                        <span class="font-bold text-gray-700">Kuantitas:</span>
                        <div class="flex items-center mt-2">
                            <button id="btn-minus" class="text-gray-500 bg-gray-200 rounded-l-lg px-3 py-1 hover:bg-gray-300">-</button>
                            <input id="quantity-input" class="w-12 text-center bg-gray-100" type="text" value="1" readonly>
                            <button id="btn-plus" class="text-gray-500 bg-gray-200 rounded-r-lg px-3 py-1 hover:bg-gray-300">+</button>
                        </div>
                    </div>
                    
                    <div class="flex -mx-2 mb-4">
                        <div class="w-1/2 px-2">
                            <button class="w-full bg-indigo-600 text-white py-3 px-4 rounded-full font-bold hover:bg-indigo-500">Tambah ke Keranjang</button>
                        </div>
                        <div class="w-1/2 px-2">
                            {{-- TOMBOL INI YANG AKAN MEMBUKA POP-UP --}}
                            <button id="buy-now-btn" class="w-full bg-gray-200 text-gray-800 py-3 px-4 rounded-full font-bold hover:bg-gray-300">Beli Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- KODE POP-UP MODAL --}}
    <div id="buy-now-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md">
            <h3 class="text-2xl font-bold mb-6 text-center">Konfirmasi Pembelian</h3>
            
            <div class="flex items-center space-x-4 mb-6">
                <img src="{{ url('storage/' . $produk->gambar_produk) }}" class="w-24 h-24 rounded-lg object-cover">
                <div>
                    <p class="font-bold text-lg">{{ $produk->nama_produk }}</p>
                    <p class="text-gray-600">Harga: Rp. {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                    <p class="text-gray-600">Kuantitas: <span id="modal-quantity">1</span></p>
                </div>
            </div>
            
            <div class="border-t border-b py-4 mb-6">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-medium text-gray-800">Total Harga</span>
                    <span id="modal-total-price" class="text-2xl font-bold text-indigo-600">Rp. {{ number_format($produk->harga_produk, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="mb-6">
                <p class="font-bold mb-2">Transfer ke Nomor Rekening:</p>
                <div class="bg-gray-100 p-3 rounded-lg">
                    <p class="font-mono text-lg">Bank ABC: 123-456-7890</p>
                    <p class="text-sm text-gray-500">a/n Toko Anda</p>
                </div>
            </div>

            <div class="flex justify-between space-x-4">
                <button id="cancel-btn" class="w-1/2 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">Batal</button>
                <button id="confirm-purchase-btn" class="w-1/2 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">Konfirmasi Pembayaran</button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil elemen-elemen yang dibutuhkan
            const buyNowBtn = document.getElementById('buy-now-btn');
            const modal = document.getElementById('buy-now-modal');
            const cancelBtn = document.getElementById('cancel-btn');
            const confirmBtn = document.getElementById('confirm-purchase-btn');

            const quantityInput = document.getElementById('quantity-input');
            const btnPlus = document.getElementById('btn-plus');
            const btnMinus = document.getElementById('btn-minus');
            
            const modalQuantity = document.getElementById('modal-quantity');
            const modalTotalPrice = document.getElementById('modal-total-price');
            const basePrice = {{ $produk->harga_produk }};

            // Fungsi untuk update kuantitas dan total harga
            function updatePrice() {
                let quantity = parseInt(quantityInput.value);
                let totalPrice = basePrice * quantity;
                modalQuantity.textContent = quantity;
                modalTotalPrice.textContent = 'Rp. ' + totalPrice.toLocaleString('id-ID');
            }

            // Event listener untuk tombol kuantitas
            btnPlus.addEventListener('click', () => {
                quantityInput.value = parseInt(quantityInput.value) + 1;
                updatePrice();
            });

            btnMinus.addEventListener('click', () => {
                let currentVal = parseInt(quantityInput.value);
                if (currentVal > 1) {
                    quantityInput.value = currentVal - 1;
                    updatePrice();
                }
            });

            // Tampilkan modal saat tombol "Beli Sekarang" diklik
            buyNowBtn.addEventListener('click', () => {
                updatePrice(); // Pastikan harga terupdate sebelum modal tampil
                modal.classList.remove('hidden');
            });

            // Sembunyikan modal saat tombol "Batal" diklik
            cancelBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            // Aksi saat tombol "Konfirmasi Pembayaran" diklik
            confirmBtn.addEventListener('click', () => {
                confirmBtn.disabled = true; // Nonaktifkan tombol untuk mencegah klik ganda
                confirmBtn.textContent = 'Memproses...';

                fetch('{{ route("checkout.now") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        produk_id: {{ $produk->id }},
                        quantity: parseInt(quantityInput.value)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Tampilkan alert sukses
                    alert(data.message);
                    // Sembunyikan modal dan reset tombol
                    modal.classList.add('hidden');
                    confirmBtn.disabled = false;
                    confirmBtn.textContent = 'Konfirmasi Pembayaran';
                    // Redirect atau refresh halaman jika perlu
                    window.location.href = '{{ route("dashboard") }}'; 
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan, coba lagi.');
                    // Reset tombol jika error
                    confirmBtn.disabled = false;
                    confirmBtn.textContent = 'Konfirmasi Pembayaran';
                });
            });
        });
    </script>
    @endpush
</x-app-layout>