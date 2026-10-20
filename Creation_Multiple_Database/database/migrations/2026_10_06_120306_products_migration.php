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
        Schema::dropIfExists('products_tb');
        Schema::create('products_tb', function(Blueprint $d){
            $d->id('products_pk');
            $d->string('products_name');
            $d->integer('products_amount')->default(0);
            $d->string('SKU')->unique();


            $d->foreignId('products_category_fk')
            ->references('sub_category_pk')
            ->on('sub_category_tb') 
            ->restrictOnDelete()
            ->cascadeOnUpdate();
            
            $d->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_tb');
    }
};
