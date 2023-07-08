<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = [
        'category_id',
        'name',
    ];

    protected $hidden;

    public function produk()
    {
        return $this->hasOne(Produk::class, 'kategori_id');
    }
}
