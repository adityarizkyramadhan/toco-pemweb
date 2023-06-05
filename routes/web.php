<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get("/login", [SessionController::class, 'index'])->name("login");
Route::post('/login', [SessionController::class, 'login'])->name('login.post');

Route::get('/register', [SessionController::class, 'registerPage'])->name('register');
Route::post('/register', [SessionController::class, 'register'])->name('register.post');

Route::middleware(['auth'])->group(function () {
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete("/cart/{id}", [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/keranjangcheckout', [CartController::class, 'keranjangCheckout'])->name('cart.checkout');
    Route::post('/cartCheckOut', [PaymentController::class, 'cartCheckOut'])->name('cart.checkout.post');

    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send.message');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::get('/success', [PaymentController::class, 'updatePayment'])->name('success.payment');

    Route::get('/product', [ProductController::class, 'index'])->name('firstpage');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');
    // Payment
    Route::get('/product/{idProduct}/price/{price}', [PaymentController::class, 'showCheckoutForm'])->name('product.price');
    Route::post('/checkout', [PaymentController::class, 'checkOut'])->name('product.checkout');
    // History
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
});
