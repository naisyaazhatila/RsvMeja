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
        Schema::table('menus', function (Blueprint $table) {
            $table->boolean('is_vegetarian')->default(false)->after('is_available');
            $table->boolean('is_spicy')->default(false)->after('is_vegetarian');
            $table->enum('spicy_level', ['none', 'mild', 'medium', 'hot', 'extra_hot'])->default('none')->after('is_spicy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn(['is_vegetarian', 'is_spicy', 'spicy_level']);
        });
    }
};
