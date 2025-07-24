<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function addItem(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $produkId = $request->produk_id;
        $quantity = $request->quantity;
        $userId = Auth::id();

        $cartItem = Cart::where('user_id', $userId)
                        ->where('produk_id', $produkId)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'produk_id' => $produkId,
                'quantity' => $quantity,
            ]);
        }
        return response()->json(['message' => 'Produk berhasil ditambahkan!']);
    }

    public function getItems()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('produk')->latest()->get();
        
        $subtotal = $cartItems->sum(function ($item) {
            return $item->produk->harga_produk * $item->quantity;
        });

        return response()->json([
            'items' => $cartItems,
            'subtotal' => $subtotal
        ]);
    }

    public function updateItem(Request $request, Cart $cart)
    {
        // Pastikan item ini milik pengguna yang sedang login
        if ($cart->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate(['quantity' => 'required|integer|min:1']);
        
        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json(['message' => 'Kuantitas berhasil diperbarui.']);
    }

    public function removeItem(Cart $cart)
    {
        // Pastikan item ini milik pengguna yang sedang login
        if ($cart->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $cart->delete();

        return response()->json(['message' => 'Item berhasil dihapus.']);
    }

    public function getTotalItems()
    {
        $total = Cart::where('user_id', Auth::id())->sum('quantity');
        return response()->json(['total' => $total]);
    }
}