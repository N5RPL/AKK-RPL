<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.register');
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'integer', 'min:9', 'unique:users,nis'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:3']
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($user) {
            Alert::success('Registrasi berhasil! Silakan login');
            return redirect()->route('login.index');
        } else {
            Alert::error('Registrasi gagal! Silakan coba lagi');
            return redirect()->back();
        }
    }
}
