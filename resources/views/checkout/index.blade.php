<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900 space-y-6">
                    <h1 class="text-2xl font-bold">Konfirmasi Pesanan Anda</h1>

                    <div class="border-b pb-4">
                        <h3 class="font-semibold mb-4">Rincian Barang</h3>
                        @foreach ($cartItems as $item)
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <img src="{{ url('storage/' . $item->produk->gambar_produk) }}" class="w-16 h-16 object-cover rounded-md mr-4">
                                    <div>
                                        <p class="font-semibold">{{ $item->produk->nama_produk }}</p>
                                        <p class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->produk->harga_produk) }}</p>
                                    </div>
                                </div>
                                <p class="font-semibold">Rp {{ number_format($item->produk->harga_produk * $item->quantity) }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-b pb-4 space-y-2">
                        <h3 class="font-semibold mb-4">Rincian Pembayaran</h3>
                        <div class="flex justify-between">
                            <p class="text-gray-600">Subtotal</p>
                            <p class="font-semibold">Rp {{ number_format($subtotal) }}</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-gray-600">Biaya Pengiriman</p>
                            <p class="font-semibold">Rp {{ number_format($shippingCost) }}</p>
                        </div>
                        <div class="flex justify-between text-xl font-bold mt-2 pt-2 border-t">
                            <p>Total Pembayaran</p>
                            <p>Rp {{ number_format($total) }}</p>
                        </div>
                    </div>

                    <div class="border-b pb-4">
                        <h3 class="font-semibold mb-2">Informasi Pembayaran</h3>
                        <p>Silakan transfer ke rekening berikut:</p>
                        <div class="mt-2 bg-gray-100 p-3 rounded-lg">
                            <p class="font-mono text-lg">Bank ABC: 123-456-7890</p>
                            <p class="text-sm text-gray-500">a/n Toko Anda</p>
                        </div>
                    </div>

                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        @if($isBuyNow)
                            <input type="hidden" name="is_buy_now" value="1">
                            <input type="hidden" name="buy_now_produk_id" value="{{ $cartItems->first()->produk->id }}">
                            <input type="hidden" name="buy_now_quantity" value="{{ $cartItems->first()->quantity }}">
                        @endif

                        <div class="pt-6 mt-6">
                            <h3 class="text-lg font-semibold mb-4">Alamat Pengiriman</h3>
                            <div>
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                                <textarea 
                                    name="shipping_address" 
                                    id="shipping_address" 
                                    rows="4" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                                    placeholder="Contoh: Jl. Teknologi No. 123, Kel. Sukapura, Kec. Cibiru, Kota Bandung, Jawa Barat, 40294" 
                                    required></textarea>
                                @error('shipping_address')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <x-primary-button class="w-full text-center mt-3">
                            <span class="w-full">Konfirmasi & Buat Pesanan</span>
                        </x-primary-button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>