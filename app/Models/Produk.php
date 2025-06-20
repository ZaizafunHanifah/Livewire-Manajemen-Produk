<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'nama_produk',
        'harga',
        'stok',
        'kategori_id',
        'supplier_id'
    ];

    public function kategori() { return $this->belongsTo(Kategori::class); }
    public function supplier() { return $this->belongsTo(Supplier::class); }
}

// app/Models/Kategori.php
class Kategori extends Model
{
    public function produks() { return $this->hasMany(Produk::class); }
}

// app/Models/Supplier.php
class Supplier extends Model
{
    public function produks() { return $this->hasMany(Produk::class); }
}