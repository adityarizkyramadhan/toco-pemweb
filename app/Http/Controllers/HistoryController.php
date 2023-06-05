<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        // Joinkan payment dengan product
        $data = Payment::join('products', 'payments.product_id', '=', 'products.id')
            ->where('payments.user_id', Auth::user()->id)
            ->get(['payments.*', 'products.name as product_name', 'products.image as product_image']);

        return view('history/index', compact('data'));
    }
}
