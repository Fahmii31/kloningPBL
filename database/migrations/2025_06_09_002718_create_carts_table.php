<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->string('code_cart')->primary(); // Format bebas, bisa pakai UUID / generator unik
            $table->string('user_email'); // Ganti dari user_id ke email
            $table->string('code_product');
            $table->integer('quantity')->default(1);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();

            // Foreign keys
            //$table->string('user_email');
            $table->foreign('user_email')
                ->references('email')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('code_product')
                ->references('code_product')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }

};
