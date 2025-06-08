<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data statis penjualan per bulan (contoh)
        $salesData = [
            'Jan' => 5000,
            'Feb' => 6200,
            'Mar' => 7800,
            'Apr' => 8500,
            'May' => 9200,
            'Jun' => 7600,
            'Jul' => 8900,
            'Aug' => 9100,
            'Sep' => 9500,
            'Oct' => 8800,
            'Nov' => 9800,
            'Dec' => 10500,
        ];

        // Jika kamu sudah punya model Order dan User, kamu bisa aktifkan ini untuk data dinamis:
        // $totalUsers = User::count();
        // $totalOrders = Order::count();
        // $totalSales = Order::sum('total_price');

        // Sebagai contoh saya tetap buat variabel agar view tidak error
        $totalUsers = 40689; 
        $totalOrders = 10293; 
        $totalSales = 89000;

        return view('pages.admin.dashboard', [
            'salesData'   => $salesData,
            'totalUsers'  => $totalUsers,
            'totalOrders' => $totalOrders,
            'totalSales'  => $totalSales,
            'active_menu' => 'dashboard'
        ]);
    }
}
