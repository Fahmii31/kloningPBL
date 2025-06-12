<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;

// Namespace Pembeli
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailproductController;
use App\Http\Controllers\viewAllController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\PasswordResetLinkController;

// Namespace Penjual
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\productController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\PasswordController;

Route::get('/', fn () => view('welcome'));
Route::get('profile', fn () => view('pages/profile'));
Route::get('about', fn () => view('pages/about'));
Route::get('contact', fn () => view('pages/contact'));

Route::get('/orderList', fn () => view('pages/pembeli/orderList'));
Route::get('/productAdmin', fn () => view('pages/admin/productAdmin'));
Route::get('/editProduk', fn () => view('pages/admin/editProduk'));
Route::get('/setting', fn () => view('pages/admin/setting'));
Route::get('/manage_product2', fn () => view('pages/admin/manage_product2'));

Route::middleware('auth')->group(function () {
    Route::get('/home_page', [ProductController::class, 'tampilHome'])->name('home_page');
});

Route::get('/register', [AuthController::class, 'tampilRegister'])->name('register');
Route::post('/register', [AuthController::class, 'dataRegister'])->name('dataRegister');

Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');

Route::post('/login', [AuthController::class, 'dataLogin'])->name('dataLogin');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Bagian forgot-password pakai versi Fahmi (controller-based)
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/productAdmin', [ProductAdminController::class, 'tampilProduk'])->name('produkAdmin');
Route::get('/home_page', [ProductController::class, 'tampilHome'])->name('home_page');
Route::get('category', [ProductController::class, 'tampilKategori'])->name('category');
Route::get('/product/{code_product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/category', [ProductController::class, 'tampilKategori'])->name('tampilKategori');

Route::middleware(['auth'])->group(function () {
    Route::get('/change-password', [PasswordController::class, 'edit'])->name('change.password');
    Route::post('/change-password', [PasswordController::class, 'update'])->name('change.password.update');
});

Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/product', [productController::class, 'tampilProduk'])->name('products');
Route::get('/products', [ViewAllController::class, 'tampilProduk'])->name('products');
Route::get('/kategori/{category}', [ProductController::class, 'showCategory'])->name('category');

// cart and checkout
Route::post('/cart/add/{code_product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::put('/cart/update/{code_product}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{code_product}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
Route::post('/cart/checkout-preview', [CartController::class, 'goToCheckout'])->name('checkout.preview');
Route::get('/checkout', [CheckoutController::class, 'showCheckoutPage'])->name('checkout.page');
Route::post('/checkout/submit', [CheckoutController::class, 'checkout'])->name('checkout.submit');

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/inbox', [InboxController::class, 'index'])->name('inbox');
Route::post('/inbox/send-message', [InboxController::class, 'sendMessage'])->name('inbox.send-message');

Route::get('/order', [OrderController::class, 'order'])->name('order');

Route::get('/sales', [SalesController::class, 'sales'])->name('sales');

Route::get('manage_product', [SellerController::class, 'index'])->name('manage_product.index');
Route::post('manage_product', [SellerController::class, 'store'])->name('manage_product.store');
Route::put('/admin/manage_product/{code_product}', [SellerController::class, 'update'])->name('manage_product.update');
Route::delete('/manage_product/{code_product}', [ProductController::class, 'destroy'])->name('manage_product.delete');


//setting
Route::get('/admin/settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
Route::post('/admin/settings', [SiteSettingController::class, 'update'])->name('settings.update');

//Team
Route::prefix('team')->group(function () {
    Route::get('/', [TimController::class, 'index'])->name('team.index');
    Route::get('/create', [TimController::class, 'create'])->name('team.create');
    Route::post('/store', [TimController::class, 'store'])->name('team.store');

});

// Stock
Route::get('/admin/manage_stock', [StockController::class, 'index'])->name('manage_stock');
Route::get('/admin/manage_stock/{code_product}', [StockController::class, 'show'])->name('manage_stock.show');

Route::get('/admin/manage_stock/{category}', [StockController::class, 'show'])->name('stock_detail');

Route::get('/stock/{category}/{merk}', [StockController::class, 'showByMerk'])->name('product_stock');

Route::put('/stock/update/{id}', [StockController::class, 'updateSingle'])->name('stock.updateSingle');
Route::delete('/manage_product/{code_product}', [SellerController::class, 'destroy'])->name('manage_product.destroy');

// Category
Route::resource('category', CategoryController::class);
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/{code}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/category/{code}/product', [CategoryController::class, 'showProduct'])->name('category.product');
Route::patch('/category/{code}/status', [CategoryController::class, 'updateStatus'])->name('category.updateStatus');

Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::delete('/category/{code}', [CategoryController::class, 'destroy'])->name('category.destroy');
// Invoice
Route::post('/invoice', [InvoiceController::class, 'invoice'])->name('invoice');
Route::get('/invoice', [InvoiceController::class, 'showInvoice'])->name('invoice.show');

// Merk
Route::get('admin/merk', [MerkController::class, 'index'])->name('merk.index');
Route::post('admin/merk', [MerkController::class, 'store'])->name('merk.store');
Route::put('admin/merk/{merk}', [MerkController::class, 'update'])->name('merk.update');
Route::delete('admin/merk/{merk}', [MerkController::class, 'destroy'])->name('merk.destroy');
Route::patch('admin/merk/{merk}/status', [MerkController::class, 'updateStatus'])->name('merk.updateStatus');


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'check_role:admin']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


