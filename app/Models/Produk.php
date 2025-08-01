<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'nama_produk',
        'deskripsi_produk',
        'harga_produk',
        'gambar_produk',
        'spesifikasi',
        'info_pengiriman',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
