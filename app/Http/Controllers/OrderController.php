<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail; // Pastikan model ini di-import
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function show(Order $order)
    {
        // Pastikan pengguna hanya bisa melihat pesanannya sendiri
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Ambil data detail pesanan beserta produknya
        $order->load('details.produk');

        return view('orders.show', compact('order'));
    }

    public function uploadPaymentProof(Request $request, Order $order)
    {
        // 1. Otorisasi: Pastikan user yang upload adalah pemilik order
        // Ini sangat penting untuk keamanan!
        if (auth()->id() !== $order->user_id) {
            abort(403, 'Anda tidak memiliki akses untuk pesanan ini.');
        }

        // 2. Validasi: Pastikan file yang diupload valid
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Wajib, gambar, maks 2MB
        ]);

        // 3. Simpan File ke Storage
        // Menggunakan store() akan otomatis membuat nama file unik
        $filePath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // 4. Update Database
        // Simpan path file ke dalam kolom 'payment_proof' di order yang sesuai
        $order->update([
            'payment_proof' => $filePath,
            'status' => 'menunggu_konfirmasi' // Opsional: Ubah status pesanan
        ]);

        // 5. Redirect dengan Pesan Sukses
        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah!');
    }
}