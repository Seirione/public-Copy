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
        Schema::create('users_tb', function(Blueprint $d){
            $d->id('users_pk');
            $d->string('users_last_name');
            $d->string('users_first_name');
            $d->string('users_middle_name')->nullable();
            $d->integer('isAdmin')->default(0);
            $d->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_tb');
    }
};
