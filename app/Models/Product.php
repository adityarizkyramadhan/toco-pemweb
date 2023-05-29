<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // name
    // image
    // description
    // price
    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
    ];
}
