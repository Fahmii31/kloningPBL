<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;

class CartController extends Controller
{
    public function __construct()
    {
        // Semua method butuh user login
        $this->middleware('auth');
    }

    // Tambah produk ke keranjang
    public function addToCart(Request $request, $code_product)
    {
        // Cari produk berdasarkan code_product
        $product = Product::where('code_product', $code_product)->first();

        if (!$product) {
            // Jika produk tidak ditemukan, cek permintaan JSON atau bukan
            return $request->wantsJson()
                ? response()->json(['message' => 'Produk tidak ditemukan.'], 404)
                : redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Ambil quantity dari input, default 1
        $quantity = (int) $request->input('quantity', 1);
        if ($quantity < 1) {
            $quantity = 1; // Pastikan quantity minimal 1
        }

        $subtotal = $product->price * $quantity;
        $userEmail = Auth::user()->email;

        // Cari data cart yang sudah ada untuk produk dan user tersebut
        $existing = Cart::where('code_product', $code_product)
            ->where('user_email', $userEmail)
            ->first();

        if ($existing) {
            // Jika sudah ada, tambah quantity dan update subtotal
            $existing->quantity += $quantity;
            $existing->subtotal = $existing->quantity * $product->price;
            $existing->save();
        } else {
            // Kalau belum ada, buat data cart baru
            Cart::create([
                'code_cart' => Str::uuid(),
                'user_email' => $userEmail,
                'code_product' => $code_product,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ]);
        }

        // Hitung total item unik dalam keranjang user ini (berdasarkan produk unik)
        $cartCount = Cart::where('user_email', $userEmail)->count();

        // Kalau request AJAX (JSON), kirim pesan dan jumlah cart saat ini
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Produk berhasil ditambahkan ke keranjang.',
                'cartCount' => $cartCount,
            ]);
        }

        // Jika request biasa (bukan AJAX), redirect ke halaman cart dengan pesan sukses
        return redirect()->route('cart')->with('success', 'Produk ditambahkan ke keranjang.');
    }



    // Tampilkan isi keranjang
    public function showCart()
    {
        $userEmail = Auth::user()->email;

        $cartItems = Cart::with('product')
            ->where('user_email', $userEmail)
            ->get();

        return view('pages.pembeli.cart', ['cart' => $cartItems]);
    }

    // Update jumlah produk di keranjang
    public function updateCart(Request $request, $code_product)
    {
        $userEmail = Auth::user()->email;

        $cart = Cart::where('code_product', $code_product)
            ->where('user_email', $userEmail)
            ->first();

        if ($cart) {
            $quantity = (int) $request->input('quantity', 1);
            $cart->quantity = $quantity;
            $cart->subtotal = $quantity * $cart->product->price;
            $cart->save();
        }

        return redirect()->route('cart')->with('success', 'Keranjang diperbarui.');
    }

    // Hapus produk dari keranjang
    public function removeFromCart($code_product)
    {
        $userEmail = Auth::user()->email;

        $cart = Cart::where('code_product', $code_product)
            ->where('user_email', $userEmail)
            ->first();

        if ($cart) {
            $cart->delete();
        }

        return redirect()->route('cart')->with('success', 'Produk dihapus dari keranjang.');
    }

    // Proses checkout dengan item terpilih
    public function goToCheckout(Request $request)
    {
        $request->validate([
            'selected_items' => 'required|array',
        ]);

        $userEmail = Auth::user()->email;
        $selectedItems = $request->input('selected_items');

        $cartItems = Cart::with('product')
            ->where('user_email', $userEmail)
            ->whereIn('code_cart', $selectedItems)
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Tidak ada item yang dipilih.');
        }

        $total = $cartItems->sum('subtotal');
        $user = Auth::user();

        return view('pages.pembeli.checkout', [
            'cartItems' => $cartItems,
            'total' => $total,
            'user' => $user,
        ]);
    }
}
