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
        DB::table('prestadores')->insert([
            'nome'          => Str::random(10),
            'contato'       => '21976782020',
            'empresa_id'    => '1',
            'user_create_id'=> '1',
        ]);

        DB::table('prestadores')->insert([
            'nome'          => Str::random(10),
            'contato'       => '21975702020',
            'empresa_id'    => '2',
            'user_create_id'=> '1',
        ]);
    }
}
