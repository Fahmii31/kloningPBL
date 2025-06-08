<?php
namespace App\Http\Controllers;

class InvoiceController extends Controller
{
    public function showInvoice()
    {
        // Data dummy
        $order = [
            'id' => 'ORD12345',
            'date' => '2025-05-14',
            'name' => 'AIIS',
            'address' => 'batu aji city',
            'phone' => '123-456-7890',
            'payment_method' => 'Credit Card',
        ];

        // Data produk dummy
        $invoiceProducts = [
            [
                'id' => 1,
                'image_path' => 'image/12.png',
                'name' => 'Fan',
                'price' => 400000,
                'category' => 'Fan',
                'stock' => 15,
                'description' => 'Fan listrik dengan kecepatan tinggi untuk mendinginkan ruangan.',
                'material' => 'Plastik dan logam',
                'feature' => 'Kecepatan angin dapat diatur, hemat energi'
            ],
            [
                'id' => 2,
                'image_path' => 'image/3.png',
                'name' => 'TV-Samsung',
                'price' => 3000000,
                'category' => 'Television',
                'stock' => 10,
                'description' => 'Televisi Samsung dengan resolusi 4K dan teknologi pintar.',
                'material' => 'Kaca dan plastik',
                'feature' => 'Resolusi 4K, Smart TV, Wi-Fi built-in'
            ],
        ];

        // Menghitung sub-total dari harga produk
        $subTotal = array_sum(array_column($invoiceProducts, 'price'));

        // Mengembalikan view dengan data yang sudah diolah
        return view('pages.pembeli.invoice', compact('order', 'invoiceProducts', 'subTotal'));
    }
}
