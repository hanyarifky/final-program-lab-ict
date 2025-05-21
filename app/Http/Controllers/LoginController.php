<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\View;
use SweetAlert2\Laravel\Swal;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'nim' => 'required|size:10|string',
            'password' => 'required'
        ], [
            'nim.required' => "Nim harus Diisi",
            'nim.size' => "Tolong masukkan nim yang sesuai",
            'password.required' => "Password harus diisi"
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Swal::fire([
                'title' => 'Berhasil Login',
                'icon' => 'success',
                'confirmButtonText' => 'Oke'
            ]);

            return redirect()->intended('dashboard');
        }

        Swal::error([
            'title' => 'Login Gagal',
            'text' => "Username atau Password yang anda masukkan salah",
            'confirmButtonText' => 'Oke'
        ]);
        return back();
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
