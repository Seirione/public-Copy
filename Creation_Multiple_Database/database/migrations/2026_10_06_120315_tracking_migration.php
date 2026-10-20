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
        Schema::create('tracking_tb', function(Blueprint $d){
        $d->id('tracking_pk');
        
        $d->integer('product_amount');
        
        $d->foreignId('product_id')
        ->references('products_pk')
        ->on('products_tb')
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
        Schema::dropIfExists('tracking_tb');
    }
};
