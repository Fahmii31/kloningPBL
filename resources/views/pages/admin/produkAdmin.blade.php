@extends('layouts.admin')

@section('title', 'product')

@section('content')

<!-- Products Section -->
<h2 class="text-2xl font-semibold mb-4">Products</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Product Card -->
     @foreach($dataProduk as $produk)
    <div class="bg-white rounded-lg shadow p-4">
        <img src="{{ $produk['img'] }}" alt="{{ $produk['namaProduk'] }}" class="mx-auto">
        <h3 class="mt-2 font-medium">{{ $produk['namaProduk'] }}</h3>
        <p class="text-blue-600 font-semibold">Rp{{ $produk['harga'] }}</p>
        <button class="mt-2 px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded">Edit Product</button>
    </div>
    @endforeach
</div>
@endsection