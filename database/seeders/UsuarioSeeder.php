<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        DB::table('usuarios')->insert([
            'COD_FUNCIONARIO' => null,
            'NOME' => 'Josue Henrique',
            'SENHA' => Hash::make('123'),
            'EMAIL' => 'josue21servico@gmail.com',
            'FOTO' => 'https://josuashenrique.site/images/img1.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
