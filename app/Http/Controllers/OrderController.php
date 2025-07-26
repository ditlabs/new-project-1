<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
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
        $orders = Order::where('user_id', Auth::id())
                        ->with('details.produk')
                        ->latest()
                        ->paginate(5);

        return view('orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail pesanan tertentu milik pengguna.
     */
    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
                        ->with('details.produk')
                        ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    /**
     * Membuat pesanan untuk alur "Beli Sekarang".
     */
    public function checkoutNow(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $produk = Produk::find($request->produk_id);
        $user = Auth::user();
        $totalPrice = $produk->harga_produk * $request->quantity;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'status' => 'Belum Dikonfirmasi', // Pastikan status sesuai dengan yang Anda inginkan
            ]);

            OrderDetail::create([
                'order_id' => $order->id,
                'produk_id' => $produk->id,
                'quantity' => $request->quantity,
                'price' => $produk->harga_produk,
            ]);

            DB::commit();

            return response()->json([
                'buyer_name' => $user->name,
                'product_name' => $produk->nama_produk,
                'quantity' => $request->quantity,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan saat membuat pesanan.'], 500);
        }
    }

    /**
     * Mengunggah bukti pembayaran untuk pesanan tertentu.
     */
    public function uploadProof(Request $request, Order $order)
    {
        // 1. Validasi input
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Lebih baik menggunakan 'image' daripada 'file'
        ]);

        // 2. Simpan file di folder public agar bisa diakses
        // File akan disimpan di: storage/app/public/bukti_pembayaran
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // 3. Update kolom payment_proof_path di database
        $order->payment_proof_path = $path;
        // Status tidak diubah, biarkan tetap 'Belum Dikonfirmasi' untuk verifikasi admin
        $order->save();
        
        // 4. Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Bukti pembayaran berhasil diunggah dan sedang menunggu verifikasi.');
    }
}