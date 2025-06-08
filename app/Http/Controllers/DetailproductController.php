<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailproductController extends Controller
{
    public function detail()
    {
        return view('pages.pembeli.detail_product');
    }
}
