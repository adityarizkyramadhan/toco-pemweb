<?php

namespace App\Http\Controllers;

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
        $idProduct = $request->input('idProduct');
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
