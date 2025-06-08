@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">Manage Categories</h1>

    {{-- Add Category Button --}}
    <div class="flex justify-end mb-4">
        <button onclick="showAddCategoryForm()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            + Add Category
        </button>
    </div>

    {{-- Add Category Modal --}}
    <div id="addCategoryForm" class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-start overflow-auto pt-20 z-50">
        <div class="bg-white p-6 rounded shadow w-full max-w-lg relative">
            <h2 class="text-lg font-semibold mb-4">Add New Category</h2>

            <form action="{{ route('category.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="code" class="block font-medium mb-1">Category Code:</label>
                    <input type="text" id="code" name="code" required
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="name" class="block font-medium mb-1">Category Name:</label>
                    <input type="text" id="name" name="name" required
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="status" value="ON" class="form-checkbox text-blue-500">
                        <span class="ml-2">Active</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="hideAddCategoryForm()" class="px-4 py-2 mr-2 bg-gray-400 text-white rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Category Modal --}}
    <div id="editCategoryForm" class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-start overflow-auto pt-20 z-50">
        <div class="bg-white p-6 rounded shadow w-full max-w-lg relative">
            <h2 class="text-lg font-semibold mb-4">Edit Category</h2>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="edit_code" class="block font-medium mb-1">Category Code:</label>
                    <input type="text" id="edit_code" name="code" readonly
                        class="w-full bg-gray-100 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="edit_name" class="block font-medium mb-1">Category Name:</label>
                    <input type="text" id="edit_name" name="name" required
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" id="edit_status" name="status" value="ON" class="form-checkbox text-blue-500">
                        <span class="ml-2">Active</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="hideEditCategoryForm()" class="px-4 py-2 mr-2 bg-gray-400 text-white rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Category Table --}}
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 font-semibold">Code</th>
                    <th class="p-4 font-semibold">Name</th>
                    <th class="p-4 font-semibold text-center">Status</th>
                    <th class="p-4 font-semibold text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-4">{{ $category['code'] }}</td>
                        <td class="p-4">{{ $category['name'] }}</td>
                        <td class="p-4 text-center">
                            <form action="{{ route('category.updateStatus', $category['code']) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="border rounded p-1">
                                    <option value="ON" {{ $category['status'] == 'ON' ? 'selected' : '' }}>ON</option>
                                    <option value="OFF" {{ $category['status'] == 'OFF' ? 'selected' : '' }}>OFF</option>
                                </select>
                            </form>
                        </td>
                        <td class="p-4 text-center space-x-2">
                            <a href="javascript:void(0)"
                               onclick="showEditCategoryForm(
                                   '{{ $category['code'] }}',
                                   `{{ addslashes($category['name']) }}`,
                                   '{{ $category['status'] }}',
                                   '{{ route('category.update', $category['code']) }}'
                               )"
                               class="inline-block text-blue-600 hover:text-blue-800" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('category.destroy', $category['code']) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this category?')">
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
                        <td colspan="4" class="text-center p-4 text-gray-500">No categories available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal JavaScript --}}
<script>
    function showAddCategoryForm() {
        document.getElementById('addCategoryForm').classList.remove('hidden');
    }

    function hideAddCategoryForm() {
        document.getElementById('addCategoryForm').classList.add('hidden');
    }

    function showEditCategoryForm(code, name, status, url) {
        document.getElementById('editCategoryForm').classList.remove('hidden');

        document.getElementById('edit_code').value = code || '';
        document.getElementById('edit_name').value = name || '';
        document.getElementById('edit_status').checked = (status === 'ON');

        document.getElementById('editForm').action = url;
    }

    function hideEditCategoryForm() {
        document.getElementById('editCategoryForm').classList.add('hidden');
    }
</script>
@endsection
