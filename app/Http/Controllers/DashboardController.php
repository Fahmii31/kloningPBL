<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data penjualan per bulan
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

        // Data statistik lainnya
        $totalUsers = 40689;
        $totalOrders = 10293;
        $totalSales = 89000;

        // Return view dengan data + active_menu
        return view('pages.admin.dashboard', [
            'salesData' => $salesData,
            'totalUsers' => $totalUsers,
            'totalOrders' => $totalOrders,
            'totalSales' => $totalSales,
            'active_menu' => 'dashboard'  
        ]);
    }
}
