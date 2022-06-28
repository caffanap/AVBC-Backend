<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posisis')->insert([
            'posisi' => 'Open Spiker',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('posisis')->insert([
            'posisi' => 'Quicker',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('posisis')->insert([
            'posisi' => 'All Round Spiker',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('posisis')->insert([
            'posisi' => 'Setter/Tosser',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('posisis')->insert([
            'posisi' => 'Defender/Libero',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
