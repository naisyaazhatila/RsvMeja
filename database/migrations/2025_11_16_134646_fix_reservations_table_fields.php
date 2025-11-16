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
        Schema::table('reservations', function (Blueprint $table) {
            $table->renameColumn('number_of_people', 'guest_count');
            $table->renameColumn('special_request', 'special_requests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->renameColumn('guest_count', 'number_of_people');
            $table->renameColumn('special_requests', 'special_request');
        });
    }
};
