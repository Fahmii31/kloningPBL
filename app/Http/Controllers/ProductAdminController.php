<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    public function tampilProduk() {
        $dataProduk = [
            [
                'img' => 'image/3.png',
                'namaProduk' => 'Televisi',
                'harga' => '100.000'
            ],
            [
                'img' => 'image/4.png',
                'namaProduk' => 'Televisi 2',
                'harga' => '200.000'
            ],
            [
                'img' => 'image/4.png',
                'namaProduk' => 'Televisi 2',
                'harga' => '200.000'
            ],
            [
                'img' => 'image/4.png',
                'namaProduk' => 'Televisi 2',
                'harga' => '200.000'
            ],
            [
                'img' => 'image/4.png',
                'namaProduk' => 'Televisi 2',
                'harga' => '200.000'
            ],
            [
                'img' => 'image/4.png',
                'namaProduk' => 'Televisi 2',
                'harga' => '200.000'
            ],
            ];
            return view('pages.admin.produkAdmin', compact('dataProduk'));
    }
}
