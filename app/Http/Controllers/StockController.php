<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Category;
use App\Models\Merk;

class StockController extends Controller
{
    public function index()
    {
        $stockPerCategory = \DB::table('products as p')
            ->join('stocks as s', 'p.code_product', '=', 's.code_product')
            ->join('categories as c', 'p.category_code', '=', 'c.code')
            ->select('p.category_code', 'c.name as category_name', \DB::raw('SUM(s.stock) as total_stock'))
            ->groupBy('p.category_code', 'c.name')
            ->get();

        return view('pages.admin.stock.manage_stock', compact('stockPerCategory'));
    }

    public function show($categoryCode)
    {
        $category = Category::where('code', $categoryCode)->firstOrFail();

        $products = Product::with(['stock', 'merk'])
            ->where('category_code', $categoryCode)
            ->get();

        return view('pages.admin.stock.detail_stock', [
            'category' => $categoryCode,
            'categoryName' => $category->name,
            'products' => $products,
        ]);
    }

    public function showByMerk($categoryCode, $merkCode)
    {
        $category = Category::where('code', $categoryCode)->firstOrFail();
        $merk = Merk::where('code', $merkCode)->firstOrFail();

        $products = Product::with('stock')
            ->where('category_code', $categoryCode)
            ->where('merk_code', $merkCode)
            ->get();

        if ($products->isEmpty()) {
            abort(404, 'Produk tidak ditemukan');
        }

        return view('pages.admin.stock.product_stok', [
            'category' => $categoryCode,
            'categoryName' => $category->name,
            'merk' => $merkCode,
            'merkName' => $merk->name,
            'products' => $products,
        ]);
    }

    public function updateByCategoryMerk(Request $request, $categoryCode, $merkCode)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $products = Product::where('category_code', $categoryCode)
            ->where('merk_code', $merkCode)
            ->get();

        if ($products->isEmpty()) {
            return back()->withErrors('Tidak ada produk ditemukan untuk kategori dan merk ini.');
        }

        foreach ($products as $product) {
            $this->updateOrCreateStock($product->code_product, $request->input('stock'));
        }

        return redirect()->back()->with('success', 'Stok produk berhasil diperbarui.');
    }

    public function updateSingle(Request $request, $codeProduct)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::where('code_product', $codeProduct)->firstOrFail();

        $this->updateOrCreateStock($product->code_product, $request->input('stock'));

        return back()->with('success', 'Stok berhasil diperbarui.');
    }

    /**
     * Update stock jika ada, atau buat baru.
     */
    private function updateOrCreateStock($codeProduct, $stockValue)
    {
        Stock::updateOrCreate(
            ['code_product' => $codeProduct],
            ['stock' => $stockValue]
        );
    }
}
