<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail; // Pastikan model ini di-import
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Import DB Facade untuk transaksi

class OrderController extends Controller
{
    /**
     * Menampilkan halaman riwayat & status pesanan milik pengguna.
     */
    public function index()
    {
        // Ambil semua pesanan milik pengguna yang sedang login
        $orders = Order::where('user_id', Auth::id())
                        ->with('details.produk') // Mengambil rincian pesanan dan produk terkait
                        ->latest()
                        ->paginate(5);

        return view('orders.index', compact('orders'));
    }

    /**
     * Refactored: Membuat pesanan untuk alur "Beli Sekarang"
     * menggunakan sistem order dan order_details.
     */
    public function checkoutNow(Request $request)
    {
        // Validasi input
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $produk = Produk::find($request->produk_id);
        $user = Auth::user();
        $totalPrice = $produk->harga_produk * $request->quantity;

        // Memulai transaksi database untuk memastikan semua data konsisten
        DB::beginTransaction();

        try {
            // 1. Buat "kepala nota" di tabel orders
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'status' => 'belum_dikonfirmasi',
            ]);

            // 2. Buat "rincian barang" di tabel order_details
            OrderDetail::create([
                'order_id' => $order->id,
                'produk_id' => $produk->id,
                'quantity' => $request->quantity,
                'price' => $produk->harga_produk,
            ]);

            // Jika semua berhasil, simpan perubahan
            DB::commit();

            // Kirim response berhasil
            return response()->json([
                'buyer_name' => $user->name,
                'product_name' => $produk->nama_produk,
                'quantity' => $request->quantity,
            ]);

        } catch (\Exception $e) {
            // Jika ada error, batalkan semua yang sudah disimpan
            DB::rollBack();

            // Log error untuk debugging (opsional tapi sangat direkomendasikan)
            // Log::error('Checkout Error: ' . $e->getMessage());

            // Kirim response error
            return response()->json(['message' => 'Terjadi kesalahan saat membuat pesanan.'], 500);
        }
    }
}