<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable()->after('name');
            }

            if (!Schema::hasColumn('products', 'price')) {
                $table->integer('price')->nullable()->after('description');
            }

            if (!Schema::hasColumn('products', 'warranty')) {
                $table->string('warranty')->nullable()->after('price');
            }

            if (!Schema::hasColumn('products', 'image')) {
                $table->string('image')->nullable()->after('warranty');
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['description', 'price', 'warranty', 'image']);
        });
    }
}
