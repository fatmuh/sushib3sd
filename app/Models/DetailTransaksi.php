<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $fillable = [
        'product_id',
        'transaction_id',
        'qty',
        'base_price',
        'base_total',
    ];

    protected $hidden;

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaction_id', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'product_id', 'id');
    }
}
