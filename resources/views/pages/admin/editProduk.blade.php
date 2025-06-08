@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<h2 class="text-2xl font-bold mb-8 ">Edit Products</h2>
<div class="bg-[#d9eafe] rounded-2xl shadow-xl max-w-4xl mx-auto p-10">

    <!-- Image Upload Section -->
    <div class="flex flex-col items-center mb-8">
    <div class="w-72 h-44 bg-white rounded-xl flex items-center justify-center overflow-hidden shadow-md">
      <img src="{{ $product->image ?? 'https://via.placeholder.com/300x200' }}" alt="Product Image" class="object-cover h-full w-full" />
    </div>
    <label class="mt-4">
      <input type="file" name="product_image" class="hidden" />
      <span class="bg-white text-gray-700 border border-gray-300 rounded-lg px-4 py-2 shadow hover:bg-gray-100 cursor-pointer">
        Choose File
      </span>
    </label>
  </div>

      <!-- Form Fields -->
    <form class="space-y-4 w-auto">
      <!-- Form group -->
      <div class="flex items-center justify-between bg-gray-100 px-4 py-3 rounded-xl shadow">
        <label class="font-medium w-1/3">Category :</label>
        <input type="text" placeholder="TV" class="w-2/3 bg-transparent outline-none" />
      </div>

      <div class="flex items-center justify-between bg-gray-100 px-4 py-3 rounded-xl shadow">
        <label class="font-medium w-1/3">Product Name :</label>
        <input type="text" placeholder="LG 42” LED" class="w-2/3 bg-transparent outline-none" />
      </div>

      <div class="flex items-center justify-between bg-gray-100 px-4 py-3 rounded-xl shadow">
        <label class="font-medium w-1/3">Brand :</label>
        <input type="text" placeholder="LG" class="w-2/3 bg-transparent outline-none" />
      </div>

      <div class="flex items-center justify-between bg-gray-100 px-4 py-3 rounded-xl shadow">
        <label class="font-medium w-1/3">Description :</label>
        <input type="text" placeholder="Full HD TV" class="w-2/3 bg-transparent outline-none" />
      </div>

      <div class="flex items-center justify-between bg-gray-100 px-4 py-3 rounded-xl shadow">
        <label class="font-medium w-1/3">Guarantee :</label>
        <input type="text" placeholder="2 Years" class="w-2/3 bg-transparent outline-none" />
      </div>

      <div class="flex items-center justify-between bg-gray-100 px-4 py-3 rounded-xl shadow">
        <label class="font-medium w-1/3">Price :</label>
        <input type="text" placeholder="$100" class="w-2/3 bg-transparent outline-none" />
      </div>

      <div class="flex items-center justify-between bg-gray-100 px-4 py-3 rounded-xl shadow">
        <label class="font-medium w-1/3">Piece :</label>
        <input type="text" placeholder="1" class="w-2/3 bg-transparent outline-none" />
      </div>

      <!-- Update Button -->
      <div class="flex justify-end pt-4">
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-xl shadow hover:bg-blue-600">
          Update
        </button>
      </div>
    </form>
</div>
@endsection
