<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return view('cart/index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'productId' => 'required',
        ], [
            'productId.required' => 'Product Id is required',
        ]);
        $product_id = $request->input('productId');

        $data = [
            'user_id' => Auth::user()->id,
            'product_id' => $product_id,
        ];

        Cart::create($data);

        return redirect()->route('cart.index')->with('success', 'Cart has been added');
    }
}
