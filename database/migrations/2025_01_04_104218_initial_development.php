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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->nullable(false);
            $table->string('isbn')->nullable(false);
        });

        Schema::create('book_stocks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('book_id')->nullable(false)->constrained('books', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_stocks');
        Schema::dropIfExists('books');
    }
};
