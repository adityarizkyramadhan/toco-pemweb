<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        // Dummy data 4 produk
        $products = [
            [
                'name' => 'Produk 1',
                'image' => 'path/to/image1.jpg',
                'description' => 'Deskripsi produk 1',
                'price' => 10.99,
            ],
            [
                'name' => 'Produk 2',
                'image' => 'path/to/image2.jpg',
                'description' => 'Deskripsi produk 2',
                'price' => 19.99,
            ],
            [
                'name' => 'Produk 3',
                'image' => 'path/to/image3.jpg',
                'description' => 'Deskripsi produk 3',
                'price' => 14.99,
            ],
            [
                'name' => 'Produk 4',
                'image' => 'path/to/image4.jpg',
                'description' => 'Deskripsi produk 4',
                'price' => 9.99,
            ],
        ];

        return view('product/table', compact('products'));
    }
}
