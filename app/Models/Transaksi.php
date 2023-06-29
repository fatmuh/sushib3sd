<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = [
        'transaction_code',
        'customer_name',
        'price_total',
        'accept',
        'return',
        'created_by'
    ];

    protected $hidden;

    public function detail()
    {
        return $this->hasOne(Produk::class, 'transaction_id');
    }
}
