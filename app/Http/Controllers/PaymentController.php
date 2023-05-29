<?php

namespace App\Http\Controllers;

// use App\Models\Payment;
use Illuminate\Http\Request;
use Xendit\Invoice;
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
        // $message = $request->message;
        // $quantity = $request->quantity;
        // $totalPrice = $request->totalprice;
        // $status = 'pending';

        // $data = [
        //     'product_id' => 1,
        //     'user_id' => 1,
        //     'message' => $message,
        //     'quantity' => $quantity,
        //     'price' => $request->price,
        //     'total-price' => $totalPrice,
        //     'status' => $status,
        // ];
        Xendit::setApiKey('xnd_development_ufT0WRaRALNj3a9JSFx9oLGaylW9Sef8j8Qib7ND5Y05DhtNWFULVpA6CKqft2');
        // $payment = Payment::create($data);

        // Kirim ke halaman payment Xendit
        $params = [
            'external_id' => 'demo_147580196270',
            'payer_email' => 'sample_email@xendit.co',
            'description' => 'Trip to Bali',
            'amount' => 320000,
        ];

        $invoice = Invoice::create($params);
        var_dump($invoice);
    }
}
