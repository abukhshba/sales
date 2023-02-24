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
        Schema::create('product_bills', function (Blueprint $table) {
            $table->foreignId('bill_id')->references('id')->on('bills')->onDelete('cascade' );
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade' );
            $table->unique(['bill_id', 'product_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_bills');
    }
};
