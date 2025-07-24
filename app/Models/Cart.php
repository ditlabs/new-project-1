<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'produk_id',
        'quantity',
    ];

    /**
     * Mendapatkan data produk yang terkait dengan item keranjang ini.
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    /**
     * Mendapatkan data pengguna yang memiliki item keranjang ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}