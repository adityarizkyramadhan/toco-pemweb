<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'quantity',
        'price',
        'total-price',
        'status',
        'product_id',
        'user_id',
    ];
}
