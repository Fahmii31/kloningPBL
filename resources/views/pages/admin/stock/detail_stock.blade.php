@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Manage Stock</h1>

    {{-- Judul kategori --}}
    <h2 class="text-xl font-semibold mb-4">{{ $categoryName ?? ($category ?? 'Semua Kategori') }}</h2>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full text-left border-collapse table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 font-semibold">Merk</th>
                    <th class="px-4 py-2 font-semibold">Stock</th>
                    <th class="px-4 py-2 font-semibold">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grouped = $products->groupBy('merk_code');
                @endphp

                @forelse($grouped as $merkCode => $produkMerk)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">
                            {{ $produkMerk->first()->merk->name ?? 'Unknown Merk' }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $produkMerk->sum(fn($p) => $p->stock->stock ?? 0) }}
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ route('product_stock', ['category' => $category, 'merk' => $merkCode]) }}"
                               class="text-blue-600 hover:underline whitespace-nowrap">
                                Lihat Product
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

    <a href="{{ route('manage_stock') }}" class="inline-block mt-6 text-blue-600 hover:underline">Kembali ke Daftar Kategori</a>
</div>
@endsection
