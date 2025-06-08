<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ======================= REGISTER =========================

    public function tampilRegister() {
        return view('auth.register');
    }

    public function dataRegister(Request $request) 
    {
        $request->validate([
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|max:50',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'pembeli',
            'status' => 'active',
        ]);

        // Optional: langsung login pembeli
        Auth::login($user);

        return redirect()->route('tampilLogin')->with('success', 'Registrasi berhasil, silakan login');
    }

    // ======================= LOGIN =========================

    public function tampilLogin() {
        return view('auth.login');
    }

    public function dataLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|max:50'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Tambahan: hanya user aktif yang bisa login
            if ($user->status !== 'active') {
                Auth::logout();
                return back()->with('failed', 'Akun Anda tidak aktif');
            }

            // Arahkan berdasarkan role
            if ($user->role === 'admin') {
                return redirect('/dashboard');
            }

            return redirect('/home_page');
        }

        return back()->with('failed', 'Email atau kata sandi salah');
    }

    // ======================= LOGOUT =========================

    public function logout()
    {
        Auth::logout();
        return redirect()->route('tampilLogin')->with('success', 'Anda telah logout');
    }
}
