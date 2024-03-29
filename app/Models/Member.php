<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';
    protected $fillable = [
        'uuid',
        'name',
        'phone',
        'address',
    ];

    protected $hidden;
}
