<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>

        <div id="cart-overlay" class="fixed inset-0 backdrop-blur-sm z-40 hidden"></div>

        <div id="cart-popup" class="fixed top-20 right-20 w-full max-w-md bg-white rounded-xl shadow-2xl z-50 transform translate-x-[120%] transition-transform duration-500 ease-in-out">
            <div class="flex flex-col max-h-[80vh]">
                <div class="flex justify-between items-center p-5 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Keranjang Belanja</h2>
                    <button id="close-cart-btn" class="text-gray-400 hover:text-gray-800 text-3xl">&times;</button>
                </div>
                <div id="cart-popup-body" class="p-6 overflow-y-auto">
                    </div>
                <div class="p-6 mt-auto border-t bg-gray-50 rounded-b-xl">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-lg text-gray-600">Subtotal</span>
                        <span id="cart-subtotal" class="text-2xl font-bold text-gray-900">Rp 0</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" id="checkout-link" class="w-full text-center block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-4 rounded-lg transition-transform transform hover:scale-105">
                        Lanjut ke Checkout
                    </a>
                </div>
            </div>
        </div>
        @stack('scripts')

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Deklarasi elemen
                const cartButton = document.getElementById('cart-button');
                const cartPopup = document.getElementById('cart-popup');
                const closeCartBtn = document.getElementById('close-cart-btn');
                const cartPopupBody = document.getElementById('cart-popup-body');
                const cartSubtotal = document.getElementById('cart-subtotal');
                const cartBadge = document.getElementById('cart-badge');
                const cartOverlay = document.getElementById('cart-overlay');
                const cartButtonMobile = document.getElementById('cart-button-mobile');

                // Fungsi untuk membuka pop-up
                function openCartPopup() {
                    cartOverlay.classList.remove('hidden');
                    cartPopup.classList.remove('translate-x-[120%]');
                    cartPopupBody.innerHTML = '<p class="text-center text-gray-500 py-8">Memuat item...</p>';

                    fetch('{{ route("keranjang.items") }}')
                        .then(response => response.json())
                        .then(data => {
                            cartPopupBody.innerHTML = '';
                            if (data.items && data.items.length > 0) {
                                data.items.forEach(item => {
                                    const itemHtml = `
                                        <div class="cart-item grid grid-cols-6 gap-4 items-center mb-4 pb-4 border-b last:border-b-0 last:mb-0 last:pb-0" data-id="${item.id}">
                                            <img src="/storage/${item.produk.gambar_produk}" class="col-span-1 w-16 h-16 rounded-lg object-cover">
                                            <div class="col-span-3">
                                                <p class="font-semibold text-gray-800">${item.produk.nama_produk}</p>
                                                <p class="text-sm text-gray-500">Rp ${item.produk.harga_produk.toLocaleString('id-ID')}</p>
                                            </div>
                                            <div class="col-span-2 flex items-center justify-end">
                                                <div class="flex items-center border rounded-md">
                                                    <button class="update-quantity-btn px-2 py-1 text-gray-600 hover:bg-gray-100" data-action="decrease">-</button>
                                                    <input type="text" value="${item.quantity}" class="quantity-input w-8 text-center text-sm font-semibold border-none bg-transparent" readonly>
                                                    <button class="update-quantity-btn px-2 py-1 text-gray-600 hover:bg-gray-100" data-action="increase">+</button>
                                                </div>
                                                <button class="remove-item-btn ml-4 text-gray-400 hover:text-red-500 text-xl">&times;</button>
                                            </div>
                                        </div>`;
                                    cartPopupBody.innerHTML += itemHtml;
                                });
                                cartSubtotal.textContent = 'Rp ' + data.subtotal.toLocaleString('id-ID');
                            } else {
                                cartPopupBody.innerHTML = `
                                    <div class="text-center py-10">
                                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-cart-7359557-6024626.png" alt="Keranjang Kosong" class="mx-auto w-32 h-32">
                                        <h4 class="mt-4 text-lg font-semibold text-gray-700">Keranjang Anda Kosong</h4>
                                        <p class="text-gray-500 mt-1">Yuk, isi dengan barang impianmu!</p>
                                    </div>
                                `;
                                cartSubtotal.textContent = 'Rp 0';
                            }
                        });
                }

                // Fungsi untuk menutup pop-up
                function closeCartPopup() {
                    cartPopup.classList.add('translate-x-[120%]');
                    cartOverlay.classList.add('hidden');
                }

                // Fungsi untuk memperbarui badge di navigasi
                function updateCartBadge() {
                    if (!cartBadge) return;
                    fetch('{{ route("keranjang.total") }}').then(res => res.json()).then(data => {
                        if (data.total > 0) {
                            cartBadge.textContent = data.total;
                            cartBadge.style.display = 'flex';
                        } else {
                            cartBadge.style.display = 'none';
                        }
                    });
                }

                // Event Listeners utama
                if(cartButton) cartButton.addEventListener('click', openCartPopup);
                if(cartButtonMobile) {
                    cartButtonMobile.addEventListener('click', function(e) {
                        e.preventDefault();
                        openCartPopup();
                    });
                }
                if(closeCartBtn) closeCartBtn.addEventListener('click', closeCartPopup);
                if(cartOverlay) cartOverlay.addEventListener('click', closeCartPopup);
                
                // Mendengarkan "sinyal" dari halaman lain
                document.addEventListener('cartUpdated', function() {
                    updateCartBadge();
                    if (!cartPopup.classList.contains('translate-x-[120%]')) {
                        openCartPopup();
                    }
                });

                // Listener untuk aksi di dalam pop-up
                cartPopupBody.addEventListener('click', function(event) {
                    const target = event.target;
                    const cartItemDiv = target.closest('.cart-item');
                    if (!cartItemDiv) return;
                    const cartId = cartItemDiv.dataset.id;
                    if (target.classList.contains('remove-item-btn')) {
                        fetch(`/keranjang/hapus/${cartId}`, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                        }).then(() => {
                            openCartPopup();
                            updateCartBadge();
                        });
                    }
                    if (target.classList.contains('update-quantity-btn')) {
                        const quantityInput = cartItemDiv.querySelector('.quantity-input');
                        let currentQuantity = parseInt(quantityInput.value);
                        const action = target.dataset.action;
                        if (action === 'increase') currentQuantity++;
                        else if (action === 'decrease' && currentQuantity > 1) currentQuantity--;
                        else return;
                        
                        fetch(`/keranjang/update/${cartId}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ quantity: currentQuantity })
                        }).then(() => {
                            openCartPopup();
                            updateCartBadge();
                        });
                    }
                });

                // Memperbarui badge saat halaman pertama kali dimuat
                updateCartBadge();
            });
        </script>
        </body>
</html>