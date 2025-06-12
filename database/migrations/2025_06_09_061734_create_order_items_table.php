<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // Kolom yang akan menjadi foreign key
            $table->string('order_code'); // FK ke orders.order_code
            $table->string('code_product'); // FK ke products.code_product

            $table->integer('quantity');
            $table->decimal('subtotal', 12, 2); // harga * quantity
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('order_code')->references('order_code')->on('orders')->onDelete('cascade');
            $table->foreign('code_product')->references('code_product')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
