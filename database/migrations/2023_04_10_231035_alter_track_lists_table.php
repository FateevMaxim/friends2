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
        Schema::table('track_lists', function (Blueprint $table) {
            $table->dateTime('to_city')->nullable();
            $table->boolean('reg_city')->default(0);
            $table->dateTime('to_client_city')->nullable();
            $table->string('city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('track_lists', function (Blueprint $table) {
            $table->dropColumn(['to_city', 'reg_city', 'to_client_city', 'city']);
        });
    }
};
