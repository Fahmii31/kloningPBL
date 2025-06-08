@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Manage Products</h1>
        <button onclick="showAddProductForm()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Product</button>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="w-full text-left border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border border-gray-300">Image</th>
                    <th class="p-2 border border-gray-300">Product Code</th>
                    <th class="p-2 border border-gray-300">Name</th>
                    <th class="p-2 border border-gray-300">Category</th>
                    <th class="p-2 border border-gray-300">Merk</th>
                    <th class="p-2 border border-gray-300">Description</th>
                    <th class="p-2 border border-gray-300">Price</th>
                    <th class="p-2 border border-gray-300">Warranty</th>
                    <th class="p-2 border border-gray-300">Stock</th>
                    <th class="p-2 border border-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="border-t border-gray-300">
                        <td class="p-2">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="Product Image" class="w-16 h-16 object-cover rounded">
                            @else
                                <span class="text-gray-400 text-sm">No Image</span>
                            @endif
                        </td>
                        <td class="p-2">{{ $product->code_product }}</td>
                        <td class="p-2">{{ $product->name }}</td>
                        <td class="p-2">{{ $product->category->name ?? '-' }}</td>
                        <td class="p-2">{{ $product->merk->name ?? '-' }}</td>
                        <td class="p-2">{{ $product->description ?? '-' }}</td>
                        <td class="p-2">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="p-2">{{ $product->warranty ?? '-' }}</td>
                        <td class="p-2">{{ $product->stock->stock ?? 0 }}</td>
                        <td class="flex m-3 items-center gap-2 border border-gray-400 bg-gray-100 rounded w-fit">
                            <button onclick='showEditForm(@json($product))' class="text-blue-600 px-4 py-2" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                            <form action="{{ route('manage_product.destroy', $product->code_product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this product?')" class="text-red-600 w-12 text-center border-l border-gray-400 py-2" title="Delete"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center p-4 text-gray-500">No products available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Product Form -->
<div id="editForm" class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-start overflow-auto pt-20 z-50">
    <div class="bg-white p-8 rounded-lg w-full max-w-lg relative shadow-lg">
        <h2 class="text-xl font-bold mb-4">Edit Product</h2>
        <form method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <!-- Hidden input for original PK -->
            <input type="hidden" name="code_product_original" />

            <div>
                <label>Image</label>
                <input type="file" name="image" id="edit-image" class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Product Code (readonly)</label>
                <input name="code_product" readonly class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" />
            </div>
            <div>
                <label>Name:</label>
                <input name="name" required class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Category:</label>
                <select name="category" required class="w-full border p-2 rounded">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->code }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Merk:</label>
                <select name="merk" required class="w-full border p-2 rounded">
                    <option value="">-- Select Merk --</option>
                    @foreach($merks as $merk)
                        <option value="{{ $merk->code }}">{{ $merk->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Description:</label>
                <textarea name="description" class="w-full border p-2 rounded"></textarea>
            </div>
            <div>
                <label>Price:</label>
                <input name="price" required type="number" step="0.01" class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Warranty:</label>
                <input name="warranty" class="w-full border p-2 rounded" />
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="hideEditForm()" class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Add New Product Form -->
<div id="addProductForm" class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-start overflow-auto pt-20 z-50">
    <div class="bg-white p-8 rounded-lg w-full max-w-xl relative shadow-lg">
        <h2 class="text-xl font-bold mb-6">Add New Product</h2>
        <form method="POST" action="{{ route('manage_product.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label>Image</label>
                <input type="file" name="image" class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Product Code</label>
                <input name="code_product" required value="{{ old('code_product') }}" class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Name</label>
                <input name="name" required value="{{ old('name') }}" class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Category</label>
                <select name="category" required class="w-full border p-2 rounded">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->code }}" {{ old('category') == $category->code ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Merk</label>
                <select name="merk" required class="w-full border p-2 rounded">
                    <option value="">-- Select Merk --</option>
                    @foreach($merks as $merk)
                        <option value="{{ $merk->code }}" {{ old('merk') == $merk->code ? 'selected' : '' }}>{{ $merk->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Description</label>
                <textarea name="description" class="w-full border p-2 rounded">{{ old('description') }}</textarea>
            </div>
            <div>
                <label>Price</label>
                <input name="price" required type="number" step="0.01" value="{{ old('price') }}" class="w-full border p-2 rounded" />
            </div>
            <div>
                <label>Warranty</label>
                <input name="warranty" value="{{ old('warranty') }}" class="w-full border p-2 rounded" />
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="hideAddProductForm()" class="px-4 py-2 mr-2 bg-gray-400 text-white rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Add Product</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showEditForm(product) {
        const form = document.getElementById('editForm');
        const f = form.querySelector('form');

        f.action = `/admin/manage_product/${product.code_product}`;

        // Hidden input original PK
        f.querySelector('input[name="code_product_original"]').value = product.code_product;

        // readonly visible input code_product
        f.querySelector('input[name="code_product"]').value = product.code_product;

        f.querySelector('input[name="name"]').value = product.name;

        f.querySelector('select[name="category"]').value = product.category?.code ?? '';
        f.querySelector('select[name="merk"]').value = product.merk?.code ?? '';

        f.querySelector('textarea[name="description"]').value = product.description ?? '';
        f.querySelector('input[name="price"]').value = product.price;
        f.querySelector('input[name="warranty"]').value = product.warranty ?? '';

        form.classList.remove('hidden');
    }

    function hideEditForm() {
        document.getElementById('editForm').classList.add('hidden');
    }

    function showAddProductForm() {
        document.getElementById('addProductForm').classList.remove('hidden');
    }

    function hideAddProductForm() {
        document.getElementById('addProductForm').classList.add('hidden');
    }
</script>

@endsection
