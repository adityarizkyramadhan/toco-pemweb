<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    function index(){
        return view('auth/login');
    }
    function registerPage(){
        return view('auth/register');
    }

    function login(Request $request){
        //validate email and password
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
        ], [
            'email.required'=>'Email is required',
            'email.email'=>'Email is invalid',
            'password.required'=>'Password is required',
            'password.min'=>'Password must be at least 5 characters',
            'password.max'=>'Password must be at most 12 characters'
        ]);
        //if validation success
        $infoLogin = [
            'email'=>$request->email,
            'password'=>$request->password
        ];
        //check email and password in database
        $user = User::where('email', $infoLogin['email'])->first();
        if(!$user){
            return redirect()->route('login')->with('error', 'Email or password is incorrect');
        }
        //check password with bcrypt
        if(!Auth::attempt($infoLogin)){
            return redirect()->route('login')->with('error', 'Email or password is incorrect');
        }
        //if success login
        return redirect()->route('firstpage');
    }
    function register(Request $request){
        //validate email and password
        $request->validate([
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:5|max:12',
            'name'=>'required',
            'address'=>'required',
            'age'=>'required'
        ], [
            'email.required'=>'Email is required',
            'email.email'=>'Email is invalid',
            'password.required'=>'Password is required',
            'password.min'=>'Password must be at least 5 characters',
            'password.max'=>'Password must be at most 12 characters',
            'name.required'=>'Name is required',
            'address.required'=>'Address is required',
            'age.required'=>'Age is required'
        ]);
        //if validation success
        $infoRegister = [
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'name'=>$request->name,
            'address'=>$request->address,
            'age'=>$request->age
        ];
        // masukkan data ke database
        $user = User::create($infoRegister);
        if($user){
            return redirect()->route('login')->with('success', 'Register success');
        }else{
            return redirect()->route('register')->with('error', 'Register failed');
        }
    }
}
