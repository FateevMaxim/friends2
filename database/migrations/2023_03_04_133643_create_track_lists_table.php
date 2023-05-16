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
        Schema::create('track_lists', function (Blueprint $table) {
            $table->id();
            $table->string('track_code')->unique();
            $table->dateTime('to_client')->nullable();
            $table->dateTime('to_china')->nullable();
            $table->dateTime('to_almaty')->nullable();
            $table->dateTime('client_accept')->nullable();
            $table->string('status')->nullable();
            $table->boolean('reg_china')->default(0);
            $table->boolean('reg_almaty')->default(0);
            $table->boolean('reg_client')->default(0);
            $table->boolean('accept_client')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_lists');
    }
};
