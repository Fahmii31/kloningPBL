@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Manage Stock</h1>

    {{-- Judul kategori dan merk --}}
    <h2 class="text-xl font-semibold mb-4">{{ $categoryName }} / {{ $merkName }}</h2>

    {{-- Tabel produk --}}
    <div class="overflow-x-auto bg-white shadow rounded-lg mb-4">
        <table class="w-full text-left border-collapse table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 font-semibold">Product Name</th>
                    <th class="px-4 py-3 font-semibold">Stock</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    @php
                        $stockValue = $product->stock->stock ?? 0;
                        $status = match(true) {
                            $stockValue == 0 => 'Habis',
                            $stockValue <= 5 => 'Hampir Habis',
                            default => 'Tersedia'
                        };
                    @endphp
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $product->name }}</td>
                        <td class="px-4 py-3">{{ $stockValue }}</td>
                        <td class="px-4 py-3">{{ $status }}</td>
                        <td class="px-4 py-3">
                            {{-- Tombol toggle form --}}
                            <button 
                                onclick="toggleForm('{{ $product->code_product }}')" 
                                class="text-blue-600 hover:underline text-sm"
                            >
                                Update Stock
                            </button>

                            {{-- Form update stok --}}
                            <form 
                                id="form-{{ $product->code_product }}" 
                                action="{{ route('stock.updateSingle', $product->code_product) }}" 
                                method="POST" 
                                class="mt-2 hidden"
                            >
                                @csrf
                                @method('PUT')
                                <div class="flex items-center gap-2 mt-2">
                                    <input 
                                        type="number" 
                                        name="stock" 
                                        value="{{ old('stock', $stockValue) }}" 
                                        min="0" 
                                        class="border rounded px-2 py-1 w-20 text-sm"
                                        required>
                                    <button 
                                        type="submit" 
                                        class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm"
                                    >
                                        Update
                                    </button>
                                </div>
                                @error('stock')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4 text-gray-500">No products available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Script toggle form --}}
<script>
    function toggleForm(id) {
        const form = document.getElementById('form-' + id);
        if (form) {
            form.classList.toggle('hidden');
        }
    }
</script>
@endsection
