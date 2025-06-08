<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    // Tampilkan halaman order list
    public function order()
    {
        // Kalau pakai database, bisa ambil data dari model Order:
        // $orders = Order::all();

        // Sekarang karena datanya masih di client-side (Alpine.js), kita cukup return view
        return view('pages.admin.order');
    }
}
