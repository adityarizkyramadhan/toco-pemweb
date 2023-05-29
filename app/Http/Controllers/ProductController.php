<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        // Dummy data 4 produk
        $products = Product::all();

        return view('product/table', compact('products'));
    }

    public function show($id)
    {
        // Get By ID
        $product = Product::find($id);

        return view('product/detail', compact('product'));
    }
}
