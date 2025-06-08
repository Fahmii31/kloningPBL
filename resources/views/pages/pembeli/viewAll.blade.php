@extends('layouts.app')

@section('title', 'viewAll')

@section('content')
<div class="container mx-auto px-6 py-6 text-gray-600 text-sm ">
    Home / Product
</div>

<!-- Main -->
<main class="container mx-auto px-6 py-6 grid grid-cols-1 md:grid-cols-4 gap-8">
    @foreach($dataProduk as $produk)
        <div class="bg-[#E2D8D8] rounded-lg shadow p-4 text-start relative">
            <a href="#" class="absolute top-2 right-2 text-gray-700 hover:text-blue-600 text-lg">
                <i class='bx bx-show'></i>
            </a>
            <div class="relative pb-4">
                <img src=" {{ $produk['img'] }}" alt="Product" class="mx-auto mb-4 w-32 h-32 object-contain">
            </div>
            <button class="w-full bg-[#373D49] text-white py-1.5 text-sm rounded-none mt-3">Add to Cart</button>
            <div class="border-t border-gray-300 pt-1">
                <h4 class="font-semibold text-xs mt-1">{{ $produk['namaProduk'] }}</h4>
                <p class="text-sm"><span class="text-blue-600 font-bold">${{ $produk['harga'] }}</span></p>
                <div class="flex justify-start text-yellow-500 my-1">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4 {{ $i < $produk['rating'] ? 'text-yellow-300' : 'text-gray-200 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                    @endfor
                </div>
            </div>
        </div>
    @endforeach
</main>
@endsection