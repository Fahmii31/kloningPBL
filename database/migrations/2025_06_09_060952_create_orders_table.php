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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('order_code')->primary();
            $table->unsignedBigInteger('user_id'); // Sesuaikan dengan PK users
            $table->decimal('total_price', 12, 2);
            $table->enum('payment_method', ['bni', 'mandiri', 'ovo', 'dana']);
            $table->string('payment_proof')->nullable();
            $table->enum('status', ['pending', 'processing', 'send', 'rejected', 'completed'])->default('pending');
            $table->timestamps();

            // ✅ Foreign key sekarang cocok
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
