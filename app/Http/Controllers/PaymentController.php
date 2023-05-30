<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Xendit\Invoice;
use Xendit\Platform;
use Xendit\Xendit;

class PaymentController extends Controller
{
    //
    public function showCheckoutForm(Request $request, $idProduct, $price)
    {
        return view('payment/checkout', ['price' => $price]);
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
        $totalprice = $price * $quantity;
        $status = 'pending';

        $data = [
            'product_id' => 1,
            'user_id' => 1,
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
        Payment::create($data);

        $params = [
            'external_id' => 'demo_147580196270',
            'payer_email' => $user->email,
            'description' => $product->name,
            'amount' => $data['total-price'],
            "failure_redirect_url" => "https://your-redirect-website.com/failure",
            "success_redirect_url" => "https://your-redirect-website.com/success",
        ];


        $invoice = Invoice::create($params);
        // Ambil invoice url

        $invoiceUrl = $invoice['invoice_url'];
        // Rdirect ke halaman payment Xendit
        return redirect($invoiceUrl);
    }
}
