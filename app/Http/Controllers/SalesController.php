<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function sales()
    {
        // Data dummy bisa diganti query DB nanti
        $sales = [
            ['id' => 1, 'product' => 'Television', 'brand' => 'LG', 'quantity' => 2, 'base_cost' => 80, 'total_cost' => 160],
            ['id' => 2, 'product' => 'Fan', 'brand' => 'Cosmos', 'quantity' => 2, 'base_cost' => 70, 'total_cost' => 140],
            ['id' => 3, 'product' => 'Dispenser', 'brand' => 'Polytron', 'quantity' => 5, 'base_cost' => 100, 'total_cost' => 500],
            ['id' => 4, 'product' => 'Rice Cooker', 'brand' => 'Maspion', 'quantity' => 4, 'base_cost' => 400, 'total_cost' => 1600],
        ];

        $total = array_sum(array_column($sales, 'total_cost'));

        return view('pages.admin.sales', compact('sales', 'total'));
    }
}


