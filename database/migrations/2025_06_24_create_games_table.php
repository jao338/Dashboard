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
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id_game');
            $table->uuid()->unique();
            $table->unsignedBigInteger('appid')->unique();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->timestamp('last_synced_at')->nullable();
            $table->timestamps();
            $table->unsignedInteger('max_players_daily')->nullable();
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
