<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    // Tampilkan halaman checkout
    public function showCheckoutPage(Request $request)
    {
        $user = Auth::user();
        $userEmail = $user->email;

        $selectedIds = $request->input('selected_items', []);
        if (empty($selectedIds)) {
            return redirect()->route('cart')->with('error', 'Pilih item terlebih dahulu.');
        }

        $cartItems = Cart::with('product')
            ->where('user_email', $userEmail)
            ->whereIn('code_cart', $selectedIds)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Item tidak ditemukan.');
        }

        $total = $cartItems->sum('subtotal');

        return view('pages.pembeli.checkout', compact('cartItems', 'total', 'user'));
    }

    // Proses submit checkout
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $userEmail = $user->email;

        $request->validate([
            'selected_items' => 'required|array',
            'payment_method' => 'required|in:bni,mandiri,ovo,dana',
            'payment_proof'  => 'nullable|image|max:2048',
        ]);

        $selectedIds = $request->input('selected_items');

        $cartItems = Cart::with('product')
            ->where('user_email', $userEmail)
            ->whereIn('code_cart', $selectedIds)
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang kosong atau item tidak ditemukan.');
        }

        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $proofPath = $request->file('payment_proof')->store('public/payment_proofs');
        }

        $orderCode = strtoupper('ORD-' . Str::random(8));

        $order = Order::create([
            'order_code'     => $orderCode,
            'user_id'        => $user->user_id,
            'total_price'    => $cartItems->sum('subtotal'),
            'payment_method' => $request->payment_method,
            'payment_proof'  => $proofPath,
            'status'         => 'PENDING',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_code'   => $order->order_code,
                'code_product' => $item->code_product,
                'quantity'     => $item->quantity,
                'price'        => $item->product->price,
                'subtotal'     => $item->subtotal,
            ]);
        }

        Cart::where('user_email', $userEmail)
            ->whereIn('code_cart', $selectedIds)
            ->delete();

        return redirect()->route('home_page')->with('success', 'Pesanan berhasil dibuat!');
    }
}
