<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Tampilkan halaman home dengan produk terbaru di hero dan list produk lainnya
    public function tampilHome()
    {
        // Produk terbaru (1 produk) beserta merk-nya
        $latestProduct = Product::with('merk')->orderBy('created_at', 'desc')->first();

        // Ambil 12 produk terbaru lainnya untuk ditampilkan, juga beserta merk-nya
        $products = Product::with('merk')->orderBy('created_at', 'desc')->take(12)->get();

        return view('pages.pembeli.home_page', compact('latestProduct', 'products'));
    }

    // Tampilkan produk berdasarkan kode kategori yang aktif
    public function showCategory($categoryCode)
    {
        $products = Product::where('category_code', $categoryCode)
            ->whereHas('category', function ($query) {
                $query->where('status', 'ON');
            })
            ->with(['merk', 'category'])
            ->get();

        return view('pages.pembeli.category', compact('products', 'categoryCode'));
    }

    // Tampilkan detail produk berdasarkan code_product (bukan ID)
    public function show($code_product)
    {
        $product = Product::with(['merk', 'category'])
            ->where('code_product', $code_product)
            ->firstOrFail();

        return view('pages.pembeli.detail_product', compact('product'));
    }
}
