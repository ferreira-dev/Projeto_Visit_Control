<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PrestadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert([
            'nome'          => Str::random(10),
            'cnpj'          => '83136049000101',
            'contato'       => '2134052995',
            'user_create_id'=> '1',
        ]);
        
        DB::table('prestadores')->insert([
            'nome'          => Str::random(10),
            'cnpj'          => '05579624000129',
            'contato'       => '2134568754',
            'user_create_id'=> '1',
        ]);


    }
}