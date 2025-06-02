<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('clientes')->insert([
            [
                'nome' => 'Cliente Padrão',
                'email' => 'cliente@email.com',
                'telefone' => '(18) 99999-9999',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    public function down(): void
    {
        DB::table('clientes')->where('email', 'cliente@email.com')->delete();
    }
};