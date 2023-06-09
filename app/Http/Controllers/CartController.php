<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // ambil data cart berdasarkan user id
        $result = Cart::where('user_id', Auth::user()->id)->get();
        $products = $result->map(function ($item) {
            return Product::find($item->product_id);
        });
        return view('cart/index', compact('products', 'result'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'productId' => 'required',
        ], [
            'productId.required' => 'Product Id is required',
        ]);

        $product_id = $request->input('productId');
        $user_id = Auth::user()->id;
        $is_checkout = false;

        $data = [
            'product_id' => $product_id,
            'user_id' => $user_id,
            'is_checkout' => $is_checkout,
        ];
        Cart::create($data);
        // return json response
        return response()->json([
            'success' => true,
            'message' => 'Success add to cart',
        ]);
    }

    public function destroy($id)
    {
        $cart = Cart::where('product_id', $id)->first();
        $cart->delete();
        return redirect()->route('cart.index') -> with('success', 'Product deleted successfully');
    }

    public function keranjangCheckout(){
        $result = Cart::where('user_id', Auth::user()->id)->get();
        $products = $result->map(function ($item) {
            return Product::find($item->product_id);
        });

        return view(
            'cart/keranjang-checkout',
            compact('products', 'result')
        );
    }
}