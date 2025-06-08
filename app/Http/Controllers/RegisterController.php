<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // Menampilkan halaman register
    public function tampilRegister() {
        return view('pages.pembeli.register');
    }
}
