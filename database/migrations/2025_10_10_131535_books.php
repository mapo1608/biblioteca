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
        Schema::create('books',function (Blueprint $table){
            $table->id();
            $table->string('title',50);
            $table->string('isbn',15)->unique()->nullable();
            $table->year('publish_year');
            $table->integer('number_pages');
            $table->string('language',20)->nullable();
            $table->unsignedBigInteger('fk_category')->nullable();
            $table->unsignedBigInteger('fk_publisher')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
