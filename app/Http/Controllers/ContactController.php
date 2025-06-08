<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Tampilkan halaman contact
    public function index()
    {
        return view('pages.pembeli.contact');
    }

    // Handle form submission
    public function send(Request $request)
    {
        // Validasi form
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:20',
            'message' => 'required|string'
        ]);

        // Bisa simpan ke database, kirim email, atau lainnya di sini
        // Contoh sementara: return redirect dengan flash message
        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
}
