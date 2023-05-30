<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

Route::get('/product', [ProductController::class, 'index'])->name('firstpage');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');

Route::middleware(['auth'])->group(function () {
    Route::get('/product/{idProduct}/price/{price}', [PaymentController::class, 'showCheckoutForm'])->name('product.price');
    Route::post('/checkout', [PaymentController::class, 'checkOut'])->name('product.checkout');
    // for success redirect
    Route::get('/success',[PaymentController::class, 'updatePayment'])->name('success.payment');

    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send.message');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
});

