<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach (getGenres() as $genre) {
            \Illuminate\Support\Facades\DB::table('tags')->insert([
                ['name' => $genre->name, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        \Illuminate\Support\Facades\DB::table('roles')->whereIn('name', getGenres())->delete();
    }
};
