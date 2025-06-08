<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimController extends Controller
{
    // Tampilkan halaman daftar tim
    public function index()
    {
        // Data dummy sementara
        $teamMembers = [
            ['name' => 'Steven Marcell Samosir', 'email' => 'stevenmarcell@gmail.com', 'img' => null],
            ['name' => 'Aisyah Nurwa Hida', 'email' => 'aisyahnurwahida60@gmail.com', 'img' => '/image/ais.png'],
            ['name' => 'Naylah Amirah Az-Zikra', 'email' => 'naylahamirah123@gmail.com', 'img' => null],
            ['name' => 'Fahmi Ahmad Fardani', 'email' => 'fahmiahmadf31070@gmail.com', 'img' => '/image/fahmi.jpg'],
        ];

        return view('pages.admin.team', compact('teamMembers'));
    }

    // Tampilkan form tambah tim
    public function create()
    {
        return view('pages.admin.add_team');
    }

    // Simpan data tim (belum ke database, hanya validasi sementara)
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Nanti kamu bisa simpan ke database di sini

        return redirect()->route('team.index')->with('success', 'Team member added successfully!');
    }
}
