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
        Schema::create('products_variations', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->comment('products');
            $table->unsignedBigInteger('variation_id')->comment('variations');

            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('variation_id')->references('id')->on('variations')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->primary(['product_id', 'variation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_variations');
    }
};
