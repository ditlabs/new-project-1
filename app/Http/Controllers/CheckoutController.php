<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout.
     * Cerdas: Bisa membedakan antara alur "Beli Sekarang" dan "Keranjang".
     */
    public function index(Request $request)
    {
        $cartItems = collect();
        $isBuyNow = false;

        // Skenario 1: Alur "Beli Sekarang" (jika ada parameter di URL)
        if ($request->has('produk_id') && $request->has('quantity')) {
            $produk = Produk::find($request->produk_id);
            if ($produk) {
                // Buat "item sementara" hanya dengan produk ini
                $item = new \stdClass();
                $item->produk = $produk;
                $item->quantity = $request->quantity;
                $cartItems->push($item);
                $isBuyNow = true;
            }
        } 
        // Skenario 2: Alur normal dari keranjang
        else {
            $itemsFromDb = Cart::where('user_id', Auth::id())->with('produk')->get();
            if ($itemsFromDb->isEmpty()) {
                return redirect()->route('dashboard')->with('error', 'Keranjang Anda kosong!');
            }
            $cartItems = $itemsFromDb;
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->produk->harga_produk * $item->quantity;
        });

        $shippingCost = 10000;
        $total = $subtotal + $shippingCost;

        return view('checkout.index', compact('cartItems', 'subtotal', 'shippingCost', 'total', 'isBuyNow'));
    }

    /**
     * Memproses pesanan.
     * Cerdas: Bisa membedakan antara alur "Beli Sekarang" dan "Keranjang".
     */
    public function process(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        $itemsToProcess = collect();
        $isBuyNow = $request->input('is_buy_now') == '1';

        // Skenario 1: Memproses "Beli Sekarang"
        if ($isBuyNow) {
            $produk = Produk::find($request->buy_now_produk_id);
            $item = new \stdClass();
            $item->produk = $produk;
            $item->produk_id = $produk->id;
            $item->quantity = $request->buy_now_quantity;
            $itemsToProcess->push($item);
        } 
        // Skenario 2: Memproses dari Keranjang
        else {
            $itemsToProcess = Cart::where('user_id', $user->id)->with('produk')->get();
        }

        if ($itemsToProcess->isEmpty()) {
            return redirect()->route('dashboard');
        }

        $totalPrice = $itemsToProcess->sum(function ($item) {
            return $item->produk->harga_produk * $item->quantity;
        }) + 10000; // Tambah ongkir

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'status' => 'belum_dikonfirmasi',
                'shipping_address' => $request->shipping_address,
            ]);

            foreach ($itemsToProcess as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'produk_id' => $item->produk_id,
                    'quantity' => $item->quantity,
                    'price' => $item->produk->harga_produk,
                ]);
            }
            
            // Hanya kosongkan keranjang jika ini BUKAN alur "Beli Sekarang"
            if (!$isBuyNow) {
                Cart::where('user_id', $user->id)->delete();
            }

            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Pesanan Anda telah berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan.');
        }
    }
}