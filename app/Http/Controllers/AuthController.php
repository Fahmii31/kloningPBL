<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan halaman register
    public function tampilRegister() {
        return view('auth.register');
    }

    // Proses data register
    public function dataRegister(Request $request) 
{
    $request->validate([
        'email' => 'required|email|max:100',
        'password' => 'required|min:8|max:50',
    ]);

    // Cek apakah email sudah terdaftar
    if (User::where('email', $request->email)->exists()) {
        return back()->with('failed', 'Email sudah terdaftar');
    }

    // Buat user baru dengan password bcrypt dan role pembeli, status active
    $user = User::create([
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'pembeli',
        'status' => 'active',
    ]);

    // Login otomatis user setelah register
    Auth::login($user);

    // Setelah register, redirect ke halaman login
    return redirect()->route('tampilLogin')->with('success', 'Registrasi berhasil, silakan login');
}

    // Menampilkan halaman login
    public function tampilLogin() {
        return view('auth.login');
    }

    // Proses data login
    public function dataLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:100',
            'password' => 'required|max:50'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            // Cek berhasil login
            if ($user->role === 'pembeli') {
                return redirect('/home_page');
            } else {
                return redirect('/dashboard');
            }
        } else {
            return back()->with('failed', 'Email atau kata sandi salah');
        }
    }

    // Menampilkan halaman logout
    public function logout() {
        Auth::logout();
        return redirect()->route('tampilLogin')->with('success', 'Anda telah berhasil logout');
    }
}
