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
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('stock')->default(0);
            $table->string('season')->nullable();
            $table->boolean('has_spikes')->default(false);
            $table->unsignedSmallInteger('width')->nullable();
            $table->unsignedSmallInteger('profile')->nullable();
            $table->string('diameter', 16)->nullable();
            $table->timestamps();

            $table->index(['category_id', 'price']);
            $table->index('season');
            $table->index('has_spikes');
            $table->index('width');
            $table->index('profile');
            $table->index('diameter');
            $table->index('name');
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
