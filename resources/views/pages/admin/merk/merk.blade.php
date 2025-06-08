@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Manage Merk</h1>

    {{-- Tombol Add --}}
    <div class="flex justify-end mb-4">
        <button onclick="showAddMerkForm()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Add New Merk
        </button>
    </div>

    {{-- Form Tambah Merk (Modal) --}}
    <div id="addMerkForm" class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-start overflow-auto pt-20 z-50">
        <div class="bg-white p-6 rounded shadow w-full max-w-lg relative">
            <h2 class="text-lg font-semibold mb-4">Tambah Merk Baru</h2>

            <form action="{{ route('merk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="code" class="block font-medium mb-1">Merk Code:</label>
                    <input type="text" id="code" name="code" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('code') }}">
                    @error('code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="name" class="block font-medium mb-1">Merk Name:</label>
                    <input type="text" id="name" name="name" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="logo" class="block font-medium mb-1">Upload Logo:</label>
                    <input type="file" id="logo" name="logo" accept="image/*" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('logo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="status" value="ON" class="form-checkbox text-blue-500" {{ old('status') == 'ON' ? 'checked' : '' }}>
                        <span class="ml-2">Active</span>
                    </label>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="hideAddMerkForm()" class="px-4 py-2 mr-2 bg-gray-400 text-white rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Merk --}}
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 font-semibold">Merk Code</th>
                    <th class="p-4 font-semibold">Merk Name</th>
                    <th class="p-4 font-semibold">Logo</th>
                    <th class="p-4 font-semibold">Status</th>
                    <th class="p-4 font-semibold text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($merks as $merk)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-4">{{ $merk->code }}</td>
                        <td class="p-4">{{ $merk->name }}</td>
                        <td class="p-4">
                            @if($merk->logo)
                                <img src="{{ asset('storage/logos/' . $merk->logo) }}" alt="Logo" class="h-8">
                            @endif
                        </td>
                        <td class="p-4 text-center">
                            <form action="{{ route('merk.updateStatus', $merk->code) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="border rounded p-1">
                                    <option value="ON" {{ $merk->status == 'ON' ? 'selected' : '' }}>ON</option>
                                    <option value="OFF" {{ $merk->status == 'OFF' ? 'selected' : '' }}>OFF</option>
                                </select>
                            </form>
                        </td>
                        <td class="p-4 text-center space-x-2">
                            <a href="javascript:void(0)"
                               onclick="showEditMerkForm(
                                   '{{ $merk->code }}',
                                   '{{ addslashes($merk->code) }}',
                                   '{{ addslashes($merk->name) }}',
                                   '{{ $merk->logo }}',
                                   '{{ $merk->status }}'
                               )"
                               class="inline-block text-blue-600 hover:text-blue-800" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('merk.destroy', $merk->code) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4 text-gray-500">No merk available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Edit Merk --}}
<div id="editMerkForm" class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-start overflow-auto pt-20 z-50">
    <div class="bg-white p-6 rounded shadow w-full max-w-lg relative">
        <h2 class="text-lg font-semibold mb-4">Edit Merk</h2>

        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="edit_code" class="block font-medium mb-1">Merk Code:</label>
                <input type="text" id="edit_code" name="code" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="edit_name" class="block font-medium mb-1">Merk Name:</label>
                <input type="text" id="edit_name" name="name" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="edit_logo" class="block font-medium mb-1">Upload Logo (optional):</label>
                <input type="file" id="edit_logo" name="logo" accept="image/*" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div id="currentLogo" class="mt-2"></div>
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" id="edit_status" name="status" value="ON" class="form-checkbox text-blue-500">
                    <span class="ml-2">Active</span>
                </label>
            </div>

            <div class="flex justify-end">
                <button type="button" onclick="hideEditMerkForm()" class="px-4 py-2 mr-2 bg-gray-400 text-white rounded">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showAddMerkForm() {
        document.getElementById('addMerkForm').classList.remove('hidden');
    }

    function hideAddMerkForm() {
        document.getElementById('addMerkForm').classList.add('hidden');
    }

    function showEditMerkForm(code, merkCode, name, logo, status) {
        const form = document.getElementById('editForm');
        form.action = '/admin/merk/' + code;

        document.getElementById('edit_code').value = merkCode;
        document.getElementById('edit_name').value = name;

        const currentLogoDiv = document.getElementById('currentLogo');
        if (logo) {
            currentLogoDiv.innerHTML = `<img src="/storage/logos/${logo}" alt="Current Logo" class="h-16 rounded border">`;
        } else {
            currentLogoDiv.innerHTML = '<span class="text-gray-500">No logo uploaded.</span>';
        }

        document.getElementById('edit_status').checked = (status === 'ON');
        document.getElementById('editMerkForm').classList.remove('hidden');
    }

    function hideEditMerkForm() {
        document.getElementById('editMerkForm').classList.add('hidden');
    }
</script>
@endsection
