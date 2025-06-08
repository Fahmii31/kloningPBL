<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class viewAllController extends Controller
{
    public function tampilProduk() {
        $dataProduk = [
            [
                'img' => 'image/20.png',
                'namaProduk' => 'Washing machine-LG',
                'harga' => '900',
                'rating' => 5,
            ],
            [
                'img' => 'image/20.png',
                'namaProduk' => 'Washing machine-LG',
                'harga' => '900',
                'rating' => 5,
            ],
            [
                'img' => 'image/20.png',
                'namaProduk' => 'Washing machine-LG',
                'harga' => '900',
                'rating' => 5,
            ],
            [
                'img' => 'image/20.png',
                'namaProduk' => 'Washing machine-LG',
                'harga' => '900',
                'rating' => 5,
            ]
        ];
        return view('pages.pembeli.viewAll', compact('dataProduk'));
    }
}
