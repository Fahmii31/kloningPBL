@extends('layouts.app')

@section('title', 'Home - E-TechnoCart')

@section('content')
<div class="grid md:grid-cols-4 gap-6"> <!-- Tambah padding di container utama -->
    <!-- Sidebar -->
    @include('components.pembeli.sidebar')

    <!-- Main Content -->
    <main class="md:col-span-3 space-y-10">
        <!-- Hero Section -->
        <!-- Hero Section -->
        <section class="relative bg-[#373D49] h-64 flex items-center justify-between px-10 py-6 overflow-hidden">
            <div>
                @if ($latestProduct)
                    <h2 class="text-2xl font-semibold text-white">{{ $latestProduct->name }}</h2>
                    <p class="text-lg text-blue-300 font-bold">New Products!!!</p>
                    <a href="{{ route('product.show', $latestProduct->code_product) }}">
                        <button class="mt-10 bg-red-600 text-white px-3 py-1 text-sm rounded">Shop Now</button>
                    </a>
                @else
                    <h2 class="text-2xl font-semibold text-white">No New Products</h2>
                @endif
            </div>

            @if ($latestProduct && $latestProduct->merk && $latestProduct->merk->logo)
                <img src="{{ asset('storage/uploads/' . $latestProduct->merk->logo) }}" 
                    alt="{{ $latestProduct->merk->name }}" 
                    class="w-40 md:w-56 lg:w-64 max-h-48 object-contain shadow-lg" />
            @elseif ($latestProduct && $latestProduct->image)
                <img src="{{ asset('storage/uploads/' . $latestProduct->image) }}" 
                    alt="{{ $latestProduct->name }}" 
                    class="w-40 md:w-56 lg:w-64 max-h-48 object-contain shadow-lg" />
            @else
                <img src="{{ asset('image/20.png') }}" 
                    alt="Default Banner" 
                    class="w-40 md:w-56 lg:w-64 max-h-48 object-contain shadow-lg" />
            @endif

            <!-- Dots indicator -->
            <div class="absolute bottom-4 flex space-x-1">
                <span class="w-2 h-2 bg-white rounded-full"></span>
                <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
                <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
            </div>
        </section>


        <!-- Product Section -->
        <section class="mt-12">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-black-900">Explore Products</h3>
                <div class="space-x-2">
                    <button class="p-2 bg-gray-200 rounded-full"><i class='bx bx-left-arrow-alt'></i></button>
                    <button class="p-2 bg-gray-200 rounded-full"><i class='bx bx-right-arrow-alt'></i></button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 px-4">
                @foreach ($products as $product)
                    @include('components.pembeli.product-card', ['product' => $product])
                @endforeach
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('products') }}" class="bg-blue-100 text-blue-700 px-6 py-2 rounded-lg hover:bg-blue-200 inline-block text-center">View All Products</a>
            </div>
        </section>
    </main>
</div>
@endsection
