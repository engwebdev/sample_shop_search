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
        Schema::create('variations', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedBigInteger('variation_title_id')->comment('variation_titles');
            $table->string('variation_title_name')->nullable();
            $table->unsignedBigInteger('variation_value_id')->comment('variation_values');
            $table->string('variation_value_name')->nullable();

            $table->string('variation_price')->nullable()
                ->comment('total price (sum) of variation excess_price');; // call for price status

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('variation_title_id')->references('id')->on('variation_titles')
                ->onUpdate('cascade')
                ->onDelete('restrict');
//            $table->foreign('variation_title_name')->references('name')->on('variation_titles')
//                ->onUpdate('cascade')
//                ->onDelete('restrict');
            $table->foreign('variation_value_id')->references('id')->on('variation_values')
                ->onUpdate('cascade')
                ->onDelete('restrict');
//            $table->foreign('variation_value_name')->references('name')->on('variation_values')
//                ->onUpdate('cascade')
//                ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variations');
    }
};
