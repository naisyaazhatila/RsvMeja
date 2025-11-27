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
        Schema::table('promos', function (Blueprint $table) {
            // Rename 'terms' to 'terms_conditions' if exists
            if (Schema::hasColumn('promos', 'terms') && !Schema::hasColumn('promos', 'terms_conditions')) {
                $table->renameColumn('terms', 'terms_conditions');
            }
            
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('promos', 'min_transaction')) {
                $table->decimal('min_transaction', 10, 2)->nullable()->after('discount_value');
            }
            
            if (!Schema::hasColumn('promos', 'max_discount')) {
                $table->decimal('max_discount', 10, 2)->nullable()->after('min_transaction');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            if (Schema::hasColumn('promos', 'terms_conditions')) {
                $table->renameColumn('terms_conditions', 'terms');
            }
            
            if (Schema::hasColumn('promos', 'min_transaction')) {
                $table->dropColumn('min_transaction');
            }
            
            if (Schema::hasColumn('promos', 'max_discount')) {
                $table->dropColumn('max_discount');
            }
        });
    }
};
