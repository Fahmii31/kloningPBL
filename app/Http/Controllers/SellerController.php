<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Models\Merk;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    public function index()
    {
        // Produk dengan eager loading relasi lengkap
        $products = Product::with(['category', 'merk', 'stock'])->get();

        // Ambil kategori dan merk yang statusnya ON saja
        $categories = Category::where('status', 'ON')->get();
        $merks = Merk::where('status', 'ON')->get();

        return view('pages.admin.manage_product', compact('products', 'categories', 'merks'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code_product' => 'required|string|max:255|unique:products,code_product',
            'name' => 'required|string|max:255',
            'category' => ['required', 'string', 'exists:categories,code', function ($attribute, $value, $fail) {
                if (!Category::where('code', $value)->where('status', 'ON')->exists()) {
                    $fail('The selected category is not available.');
                }
            }],
            'merk' => ['required', 'string', 'exists:merks,code', function ($attribute, $value, $fail) {
                if (!Merk::where('code', $value)->where('status', 'ON')->exists()) {
                    $fail('The selected merk is not available.');
                }
            }],
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'warranty' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $validatedData['image'] = 'storage/' . $imagePath;
        }

        DB::transaction(function () use ($validatedData) {
            $product = Product::create([
                'code_product' => $validatedData['code_product'],
                'name' => $validatedData['name'],
                'category_code' => $validatedData['category'],
                'merk_code' => $validatedData['merk'],
                'description' => $validatedData['description'] ?? null,
                'price' => $validatedData['price'],
                'warranty' => $validatedData['warranty'] ?? null,
                'image' => $validatedData['image'] ?? null,
            ]);

            Stock::create([
                'code_product' => $product->code_product,
                'quantity' => 0,
            ]);
        });

        return redirect()->route('manage_product.index')->with('success', 'Product added with initial stock 0!');
    }

    public function update(Request $request, $code_product)
    {
        $product = Product::findOrFail($code_product);

        $validatedData = $request->validate([
            'code_product' => "required|string|max:255|unique:products,code_product,{$code_product},code_product",
            'name' => 'required|string|max:255',
            'category' => ['required', 'string', 'exists:categories,code', function ($attribute, $value, $fail) {
                if (!Category::where('code', $value)->where('status', 'ON')->exists()) {
                    $fail('The selected category is not available.');
                }
            }],
            'merk' => ['required', 'string', 'exists:merks,code', function ($attribute, $value, $fail) {
                if (!Merk::where('code', $value)->where('status', 'ON')->exists()) {
                    $fail('The selected merk is not available.');
                }
            }],
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'warranty' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $validatedData['image'] = 'storage/' . $imagePath;
        }

        DB::transaction(function () use ($product, $validatedData) {
            $oldCode = $product->code_product;

            $product->update([
                'code_product' => $validatedData['code_product'],
                'name' => $validatedData['name'],
                'category_code' => $validatedData['category'],
                'merk_code' => $validatedData['merk'],
                'description' => $validatedData['description'] ?? null,
                'price' => $validatedData['price'],
                'warranty' => $validatedData['warranty'] ?? null,
                'image' => $validatedData['image'] ?? $product->image,
            ]);

            if ($oldCode !== $validatedData['code_product']) {
                $stock = Stock::where('code_product', $oldCode)->first();
                if ($stock) {
                    $stock->update(['code_product' => $validatedData['code_product']]);
                }
            }
        });

        return redirect()->route('manage_product.index')->with('success', 'Product updated!');
    }

    public function destroy($code_product)
    {
        $product = Product::findOrFail($code_product);

        DB::transaction(function () use ($product) {
            Stock::where('code_product', $product->code_product)->delete();
            $product->delete();
        });

        return redirect()->route('manage_product.index')->with('success', 'Product and stock deleted!');
    }
}
