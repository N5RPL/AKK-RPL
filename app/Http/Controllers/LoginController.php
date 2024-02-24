<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'nis' => ['required', 'integer', 'min:9'],
            'password' => ['required', 'string', 'min:3']
        ]);

        $credentials = $request->only('nis', 'password');
        if(Auth::attempt($credentials)) {
            Alert::success('Selamat datang di website kami!');
            return redirect()->route('home');
        } else {
            Alert::error('Login gagal! Silakan coba lagi');
            return redirect()->back();
        }
    }
}

