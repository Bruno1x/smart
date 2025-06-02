<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('marcas')->insert([
            ['nome' => 'Marca A', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Marca B', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Marca C', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        DB::table('marcas')->whereIn('nome', ['Marca A', 'Marca B', 'Marca C'])->delete();
    }
};