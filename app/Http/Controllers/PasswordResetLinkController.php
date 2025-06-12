<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Generate token manual
        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => bcrypt($token),
                'created_at' => now(),
            ]
        );

        // Buat link reset manual
        $link = url('/reset-password/' . $token . '?email=' . urlencode($request->email));

        // Sementara tampilkan linknya (bisa juga langsung redirect kalau mau)
        return redirect($link);
        
    }
}

