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
            // Only add columns if they don't exist
            if (!Schema::hasColumn('menus', 'is_vegetarian')) {
                $table->boolean('is_vegetarian')->default(false)->after('is_available');
            }
            if (!Schema::hasColumn('menus', 'is_spicy')) {
                $table->boolean('is_spicy')->default(false)->after('is_vegetarian');
            }
            if (!Schema::hasColumn('menus', 'spicy_level')) {
                $table->integer('spicy_level')->nullable()->after('is_spicy');
            }
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
