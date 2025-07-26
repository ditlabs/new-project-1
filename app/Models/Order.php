<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'user_id',
    'produk_id',
    'quantity',
    'total_price',
    'status'
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
