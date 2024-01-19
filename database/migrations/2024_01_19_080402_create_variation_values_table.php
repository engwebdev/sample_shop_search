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
        Schema::create('variation_values', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedBigInteger('variation_title_id')->comment('parent_id');
//            $table->string('variation_title_name')->nullable();

            $table->string('name')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('variation_title_id')->references('id')->on('variation_titles')
                ->onUpdate('cascade')
                ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variation_values');
    }
};
