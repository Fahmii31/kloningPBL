<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class AuthController extends Controller
{
    // ======================= REGISTER =========================

    public function tampilRegister()
    {
        return view('auth.register');
    }

   public function dataRegister(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'max:100',
                'unique:users,email',
                function ($attribute, $value, $fail) {
                    if (!str_ends_with($value, '@gmail.com')) {
                        $fail('Email harus menggunakan domain @gmail.com');
                    }
                },
            ],
            'password' => 'required|string|min:8|max:50',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email terlalu panjang',
            'email.unique' => 'Email telah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 50 karakter',
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

    public function tampilLogin()
    {
        return view('auth.login');
    }

    public function dataLogin(Request $request)

    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|max:50'
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('failed', 'Email tidak terdaftar, silahkan registrasi');
        }

        if (!\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            return back()->with('failed', 'Password Anda salah');

        }

        if ($user->status !== 'active') {
            return back()->with('failed', 'Akun Anda tidak aktif');
        }

        \Illuminate\Support\Facades\Auth::login($user);

        if ($user->role === 'admin') {
            return redirect('/dashboard');
        }

        return redirect('/home_page');
    }



    // ======================= LOGOUT =========================

    public function logout()
    {
        Auth::logout();
        return redirect()->route('tampilLogin')->with('success', 'Anda telah logout');
    }

}
