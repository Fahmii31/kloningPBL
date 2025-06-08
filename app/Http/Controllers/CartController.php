<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menambahkan produk ke dalam keranjang
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity,
                'image' => $product['image_path'],
            ];
        }

        session()->put('cart', $cart);

        // Jika request dari fetch/ajax, balas dengan JSON
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Produk berhasil ditambahkan ke keranjang!',
                'cart_count' => count($cart)
            ]);
        }

        // Jika bukan AJAX, redirect seperti biasa
        return redirect()->route('cart');
    }

    // Menampilkan keranjang belanja
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('pages.pembeli.cart', compact('cart'));
    }

    // Mengupdate jumlah produk di keranjang
    public function updateCart(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->input('quantity', 1);
        }

        session()->put('cart', $cart);
        return redirect()->route('cart');
    }

    // Menghapus produk dari keranjang
    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        session()->put('cart', $cart);
        return redirect()->route('cart');
    }

    // Menghapus semua produk dari keranjang
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('cart');
    }
    
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('pages.pembeli.checkout', compact('cart', 'total'));
    }
}