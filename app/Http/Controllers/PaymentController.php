<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Xendit\Invoice;
use Xendit\Platform;
use Xendit\Xendit;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
    public function showCheckoutForm(Request $request, $idProduct, $price)
    {
        return view('payment/checkout', ['price' => $price, 'idProduct' => $idProduct]);
    }

    public function checkOut(Request $request)
    {
        // $request->validate([
        //     'message' => 'required',
        //     'quantity' => 'required',
        //     'price' => 'required',
        //     'totalprice' => 'required',
        // ], [
        //     'message.required' => 'Message is required',
        //     'quantity.required' => 'Quantity is required',
        //     'price.required' => 'Price is required',
        //     'totalprice.required' => 'Total Price is required',
        // ]);

        $message = $request->input('message');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $idProduct = $request->input('id_product');
        $totalprice = $price * $quantity;
        $status = 'pending';



        $data = [
            'product_id' => $idProduct,
            'user_id' => Auth::user()->id,
            'message' => $message,
            'quantity' => $quantity,
            'price' => $price,
            'total-price' => $totalprice,
            'status' => $status,
        ];
        // Ambil product by Id
        $product = Product::find($data['product_id']);
        // Ambil user by Id
        $user = User::find($data['user_id']);

        Xendit::setApiKey('xnd_development_ufT0WRaRALNj3a9JSFx9oLGaylW9Sef8j8Qib7ND5Y05DhtNWFULVpA6CKqft2');
        $payment = Payment::create($data);
        // Link callbak berisi id payment untuk update status
        $linkCallback = "http://localhost:8000/success?id=" . $payment->id;
        $params = [
            'external_id' => 'demo_147580196270',
            'payer_email' => $user->email,
            'description' => $product->name,
            'amount' => $data['total-price'],
            // "failure_redirect_url" => "https://your-redirect-website.com/failure",
            "success_redirect_url" => $linkCallback,
        ];

        $invoice = Invoice::create($params);
        // Ambil invoice url

        $invoiceUrl = $invoice['invoice_url'];
        return redirect($invoiceUrl);
    }

    public function cartCheckOut(Request $request)
    {
        
        $message = $request->input('message');
        $totalprice = $request->input('totalprice');
        $status = 'pending';
        $quantity_arr = $request->input('quantity_arr');
        $result = Cart::where('user_id', Auth::user()->id)->get();
        $products = $result->map(function ($item) {
            return Product::find($item->product_id);
        });
        $quantity_arr = explode(',', $quantity_arr);
        $i = 0;
        foreach  ($products as $product) {
            $data = [
                'product_id' => $product['id'],
                'user_id' => Auth::user()->id,
                'message' => $message,
                'quantity' => $quantity_arr[$i++],
                'price' => $product['price'],
                'total-price' => $totalprice,
                'status' => $status,
            ];
            $cartToDelete = Cart::where('product_id', $product['id'])->first();
            $cartToDelete->delete();
            $payment = Payment::create($data);
        };


        // Ambil user by Id
        $user = User::find($data['user_id']);

        Xendit::setApiKey('xnd_development_ufT0WRaRALNj3a9JSFx9oLGaylW9Sef8j8Qib7ND5Y05DhtNWFULVpA6CKqft2');
        // Link callbak berisi id payment untuk update status
        $linkCallback = "http://localhost:8000/success?id=" . $payment->id;
 
        $params = [
            'external_id' => 'demo_147580196270',
            'payer_email' => $user->email,
            'description' => 'Cart',
            'amount' => $data['total-price'],
            // "failure_redirect_url" => "https://your-redirect-website.com/failure",
            "success_redirect_url" => $linkCallback,
        ];

        $invoice = Invoice::create($params);
        // Ambil invoice url

        $invoiceUrl = $invoice['invoice_url'];
        foreach  ($products as $product) {
            $data = [
                'status' => 'paid',
            ];
            $payment = Payment::where('product_id', $product['id'])->where('status', 'pending')->first();
            $payment->update($data);
        };
        return redirect($invoiceUrl);
    }

    //Update payment from redirect model Payment with status paid
    public function updatePayment(Request $request)
    {
        $data = [
            'status' => 'paid',
        ];
        // Get payment by id from query string
        $payment = Payment::find($request->input('id'));
        // Update status
        $payment->update($data);
        return view('payment/success');
    }
}