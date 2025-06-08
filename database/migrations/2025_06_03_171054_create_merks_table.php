<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerksTable extends Migration
{
    public function up()
    {
        Schema::create('merks', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('name', 255);
            $table->string('logo')->nullable();
            $table->enum('status', ['ON', 'OFF'])->default('OFF');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('merks');
    }
}
