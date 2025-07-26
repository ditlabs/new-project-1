<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Status Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">

                @forelse ($orders as $order)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 pb-4 border-b">
                                <div>
                                    <p class="text-sm text-gray-600">ID Pesanan: <span class="font-bold text-gray-800">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span></p>
                                    <p class="text-sm text-gray-500">Tanggal: {{ $order->created_at->format('d F Y') }}</p>
                                </div>
                                <div class="mt-2 sm:mt-0">
                                    <span @class([
                                        'px-3 py-1 text-xs font-semibold rounded-full',
                                        'bg-yellow-100 text-yellow-800' => $order->status === 'belum_dikonfirmasi',
                                        'bg-blue-100 text-blue-800' => $order->status === 'diproses',
                                        'bg-green-100 text-green-800' => $order->status === 'selesai',
                                        'bg-red-100 text-red-800' => $order->status === 'dibatalkan',
                                    ])>
                                        {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </div>
                            </div>

                            @foreach ($order->details as $detail)
                                <div class="flex items-center space-x-4 py-3 {{ !$loop->last ? 'border-b' : '' }}">
                                    <img src="{{ url('storage/' . $detail->produk->gambar_produk) }}" alt="{{ $detail->produk->nama_produk }}" class="w-16 h-16 rounded-md object-cover">
                                    <div class="flex-grow">
                                        <p class="font-semibold text-gray-900">{{ $detail->produk->nama_produk }}</p>
                                        <p class="text-sm text-gray-500">{{ $detail->quantity }} x Rp. {{ number_format($detail->price) }}</p>
                                    </div>
                                    <a href="{{ route('produk.detail', $detail->produk->id) }}" class="text-sm text-indigo-600 hover:underline">Beli Lagi</a>
                                </div>
                            @endforeach

                            <div class="flex justify-between items-center mt-4">
                                <p class="text-gray-600">Total Pesanan: <span class="font-bold text-gray-900">Rp. {{ number_format($order->total_price) }}</span></p>
                                
                                <a href="{{ route('orders.show', $order) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white text-center p-12 shadow-sm sm:rounded-lg">
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-cart-4078822-3375949.png" alt="Tidak ada pesanan" class="mx-auto w-40 h-40">
                        <h3 class="mt-4 text-xl font-bold text-gray-800">Anda Belum Punya Pesanan</h3>
                        <p class="mt-2 text-gray-600">Sepertinya Anda belum pernah berbelanja. Yuk, cari produk favoritmu!</p>
                        <a href="{{ route('dashboard') }}" class="mt-6 inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition-colors duration-300">
                            Mulai Belanja
                        </a>
                    </div>
                @endforelse

                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>