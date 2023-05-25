<?php

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

Route::get("/login", function () {
    return view('login');
})->name("login");

Route::post('/login', function () {
    // Logika autentikasi di sini
    // Jika login berhasil, arahkan pengguna ke halaman beranda
    return redirect()->route('home');
})->name('login.post');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register',  function (Illuminate\Http\Request $request) {
    // Logika pendaftaran di sini
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'address' => 'required',
        'age' => 'required|numeric',
    ]);

    // Cek jika validasi gagal
    if ($validator->fails()) {
        return redirect()->route('register')
            ->withErrors($validator)
            ->withInput();
    }

    // Logika pendaftaran di sini

    // Jika pendaftaran berhasil, arahkan pengguna ke halaman login
    return redirect()->route('login');
    // Jika pendaftaran berhasil, arahkan pengguna ke halaman login
    return redirect()->route('login');
})->name('register.post');
