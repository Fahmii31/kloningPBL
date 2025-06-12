@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<nav class="text-sm text-gray-600 px-4 md:px-14 mt-4 py-2">
    <a href="{{ route('home_page') }}" class="hover:underline text-blue-600">Home</a> /
    <span class="text-gray-800 font-medium">Cart</span>
</nav>

@if($cart->isEmpty())
    <div class="text-center text-gray-600 py-12">
        Keranjang kamu kosong 😢 <br>
        <a href="{{ route('home_page') }}" class="text-blue-600 hover:underline">Belanja Sekarang</a>
    </div>
@else
<div class="overflow-x-auto mt-4">
    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200 text-gray-700 text-left">
            <tr>
                <th class="py-3 px-4"><i class='bx bx-check-square'></i></th>
                <th class="py-3 px-4">Product</th>
                <th class="py-3 px-4">Price</th>
                <th class="py-3 px-4">Quantity</th>
                <th class="py-3 px-4">Subtotal</th>
                <th class="py-3 px-4">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
                @php
                    $product = $item->product;
                @endphp
                <tr class="border-t">
                    <td class="py-4 px-4 text-center">
                        <input type="checkbox" class="item-checkbox" value="{{ $item->code_cart }}" data-subtotal="{{ $item->subtotal }}">
                    </td>
                    <td class="py-4 px-4 flex items-center">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-10 h-10 mr-3 rounded shadow">
                        {{ $product->name }}
                    </td>
                    <td class="py-4 px-4">Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td class="py-4 px-4">
                        <form action="{{ route('cart.update', ['code_product' => $product->code_product]) }}" method="POST" class="flex items-center">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 border rounded px-2 py-1 text-center" />
                            <button type="submit" class="ml-2 px-3 py-1 bg-blue-500 text-white rounded">Update</button>
                        </form>
                    </td>
                    <td class="py-4 px-4">Rp {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                    <td class="py-4 px-4">
                        <form action="{{ route('cart.remove', ['code_product' => $product->code_product]) }}" method="POST">
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
        <span id="total-price">Rp 0,00</span>
    </div>

    <form id="cart-form" action="{{ route('checkout.preview') }}" method="POST">
        @csrf
        <div id="hidden-inputs"></div>
        <button type="submit" class="block w-full bg-sky-400 hover:bg-sky-500 text-white font-medium py-2 rounded text-center mt-4">
            Proceed to checkout
        </button>
    </form>
</div>
@endif

<!-- JS untuk menghitung total berdasarkan checkbox -->
<script>
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const totalPriceElement = document.getElementById('total-price');
    const hiddenInputsContainer = document.getElementById('hidden-inputs');

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 2
        }).format(angka);
    }

    function updateTotal() {
        let total = 0;
        hiddenInputsContainer.innerHTML = '';

        checkboxes.forEach(cb => {
            if (cb.checked) {
                total += parseFloat(cb.dataset.subtotal);

                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'selected_items[]';
                hiddenInput.value = cb.value;
                hiddenInputsContainer.appendChild(hiddenInput);
            }
        });

        totalPriceElement.textContent = formatRupiah(total);
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));
    document.addEventListener('DOMContentLoaded', updateTotal); // Reset total saat load ulang
</script>
@endsection
