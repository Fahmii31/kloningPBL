@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Manage Stock</h1>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 font-semibold">Category</th>
                    <th class="p-3 font-semibold">Total Stock</th>
                    <th class="p-3 font-semibold">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stockPerCategory as $product)
                    <tr class="border-t hover:bg-gray-50">
                        {{-- Tampilkan nama kategori --}}
                        <td class="p-3">{{ $product->category_name }}</td>
                        {{-- Tampilkan total stock --}}
                        <td class="p-3">{{ $product->total_stock }}</td>
                        <td class="p-3">
                            <a href="{{ route('stock_detail', ['category' => $product->category_code]) }}" class="text-blue-600 hover:underline">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center p-4 text-gray-500">No products available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
