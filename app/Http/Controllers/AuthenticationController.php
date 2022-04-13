<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    //
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('admin/dashboard');
        }else{
            return redirect("admin/login")->withError('Email atau Password anda Salah!');
        }
    }

    public function login()
    {
        if (!Auth::check()) {
            return view('login');
        } else {
            return redirect('admin/dashboard');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('admin/login');
    }
}
