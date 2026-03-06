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
        Schema::create('copies',function (Blueprint $table){
            $table->id();
            $table->string('inventory',10)->unique();
            $table->smallInteger('status');/* (1=disponibile, 2=in prestito) */
            $table->smallInteger('condition'); /* (1=ok, 2=danneggiato, 3=non prestabile) */
            $table->string('position',20);
            $table->date('buy_date')->nullable();
            $table->unsignedBigInteger('fk_book')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copies');
    }
};
