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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); //Primary Key (bigint, unsigned, auto-increment)
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2); // 8 total digits, 2 after decimal
            $table->string('image')->nullable(); // We'll store the image path
            $table->timestamps(); //Creates 'created_at' and 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
