<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout.
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('produk')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'Keranjang Anda kosong!');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->produk->harga_produk * $item->quantity;
        });

        // Kita bisa tambahkan biaya lain jika perlu, misal ongkir statis
        $shippingCost = 10000;
        $total = $subtotal + $shippingCost;

        return view('checkout.index', compact('cartItems', 'subtotal', 'shippingCost', 'total'));
    }

    /**
     * Memproses pesanan dari keranjang.
     */
    public function process(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('dashboard');
        }
        
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->produk->harga_produk * $item->quantity;
        }) + 10000; // Tambahkan ongkir lagi

        DB::beginTransaction();
        try {
            // 1. Buat "kepala nota" di tabel orders
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'status' => 'belum_dikonfirmasi',
            ]);

            // 2. Buat "rincian barang" untuk setiap item di keranjang
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'produk_id' => $item->produk_id,
                    'quantity' => $item->quantity,
                    'price' => $item->produk->harga_produk,
                ]);
            }

            // 3. Kosongkan keranjang pengguna
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            // Redirect ke halaman status pesanan dengan pesan sukses
            return redirect()->route('orders.index')->with('success', 'Pesanan Anda telah berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan.');
        }
    }
}