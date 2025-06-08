@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<nav class="text-sm text-gray-600 px-4 md:px-14 mt-4 py-2">
  <a href="{{ route('home_page') }}" class="hover:underline text-blue-600">Home</a> /
  <span class="text-gray-800 font-medium">Cart</span>
</nav>

<section class="container mx-auto px-4 py-12">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-gray-700 text-left">
                <tr>
                    <th class="py-3 px-4">Product</th>
                    <th class="py-3 px-4">Price</th>
                    <th class="py-3 px-4">Quantity</th>
                    <th class="py-3 px-4">Subtotal</th>
                    <th class="py-3 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPrice = 0;
                @endphp

                @foreach(session('cart', []) as $productId => $product)
                    @php
                        $subtotal = $product['price'] * $product['quantity'];
                        $totalPrice += $subtotal;
                    @endphp
                    <tr class="border-t">
                        <td class="py-8 px-4 flex items-center">
                            <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-8 mr-3">
                            {{ $product['name'] }}
                        </td>
                        <td class="py-8 px-4">Rp {{ number_format($product['price'], 2, ',', '.') }}</td>
                        <td class="py-8 px-4">
                            <form action="{{ route('cart.update', ['productId' => $productId]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $product['quantity'] }}" min="1" class="w-16 border rounded px-2 py-1" />
                                <button type="submit" class="ml-2 px-3 py-1 bg-blue-500 text-white rounded">Update</button>
                            </form>
                        </td>
                        <td class="py-8 px-4">Rp {{ number_format($subtotal, 2, ',', '.') }}</td>
                        <td class="py-8 px-4">
                            <form action="{{ route('cart.remove', ['productId' => $productId]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Cart Total Section and Checkout Button -->
    <div class="mt-8 bg-white p-6 shadow rounded-md max-w-sm w-full border ml-auto">
        <h3 class="text-2xl font-semibold mb-4">Cart Total</h3>
        <hr class="my-2">
        <div class="flex justify-between font-semibold text-lg mb-4">
            <span>Total:</span>
            <span>Rp {{ number_format($totalPrice, 2, ',', '.') }}</span>
        </div>

        <!-- Proceed to Checkout Button -->
        <a href="checkout" class="block w-full bg-sky-400 hover:bg-sky-500 text-white font-medium py-2 rounded text-center mt-4">Proceed to checkout</a>
    </div>
</section>
@endsection