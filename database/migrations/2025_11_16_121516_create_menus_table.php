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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('menu_categories')->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_spicy')->default(false);
            $table->integer('spicy_level')->nullable();
            $table->boolean('is_available')->default(true);
            $table->integer('view_count')->default(0);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('category_id');
            $table->index('is_available');
            $table->index('is_vegetarian');
            $table->index('is_spicy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
