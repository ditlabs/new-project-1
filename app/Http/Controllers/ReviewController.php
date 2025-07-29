<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Produk $produk)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $order = Order::find($request->order_id);
        $user = Auth::user();

        if ($order->user_id !== $user->id || $order->status !== 'selesai') {
            abort(403, 'Aksi tidak diizinkan.');
        }

        Testimonial::create([
            'user_id' => $user->id,
            'produk_id' => $produk->id,
            'name' => $user->name, 
            'title' => 'Pembeli Terverifikasi', 
            'quote' => $request->comment, 
            'rating' => $request->rating,
            'is_visible' => false,
        ]);

        return back()->with('success', 'Terima kasih atas ulasan Anda! Ulasan Anda akan kami tinjau.');
    }
}