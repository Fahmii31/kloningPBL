<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('pages.pembeli.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user->name    = $validated['name'];
        $user->phone   = $validated['phone'];
        $user->address = $validated['address'];
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}

