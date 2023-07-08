<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $fillable = [
        'product_id',
        'name',
        'kategori_id',
        'harga_jual',
    ];

    protected $hidden;

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'category_id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'produk_id');
    }

    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class, 'product_id');
    }
}
