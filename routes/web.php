<?php

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

// Route::get('/home', [ProductController::class, 'index'])->name('home');
