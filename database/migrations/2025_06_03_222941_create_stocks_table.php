<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id(); // primary key auto-increment (boleh diganti sesuai kebutuhan)
            $table->string('code_product'); // foreign key ke products.code_product
            $table->integer('stock')->default(0); // jumlah stok, default 0
            $table->timestamps();

            // Buat foreign key constraint ke tabel products
            $table->foreign('code_product')->references('code_product')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
