<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

    class DashboardController extends Controller
{
    public function index()
    {
        $produks = Produk::latest()->get(); // atau paginate(6);
        return view('dashboard', compact('produks'));
    }
}

