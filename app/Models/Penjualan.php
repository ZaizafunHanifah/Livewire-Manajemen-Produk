<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [
        'produk_id',
        'jumlah',
        'tanggal'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}