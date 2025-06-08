@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Tambah Kategori Baru</h2>

    <form action="{{ route('category.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="code" class="block font-medium mb-1">Kode Kategori:</label>
            <input type="text" id="code" name="code" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="name" class="block font-medium mb-1">Nama Kategori:</label>
            <input type="text" id="name" name="name" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="status" value="ON" class="form-checkbox text-blue-500">
                <span class="ml-2">Aktif</span>
            </label>
        </div>

        <div class="flex justify-end space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
            <a href="{{ route('category.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">Batal</a>
        </div>
    </form>
</div>
@endsection
