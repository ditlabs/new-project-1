<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
public function show($id)
{
    $produk = Produk::findOrFail($id);
    return view('produk.detail', compact('produk'));
}

}
