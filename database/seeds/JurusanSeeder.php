<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jurusans')->insert([
            'nama' => 'D3 Teknik Informatika',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jurusans')->insert([
            'nama' => 'D3 Manajemen Informatika',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jurusans')->insert([
            'nama' => 'S1 Teknik Komputer',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jurusans')->insert([
            'nama' => 'S1 Informatika',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jurusans')->insert([
            'nama' => 'S1 Teknologi Informasi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jurusans')->insert([
            'nama' => 'S1 Sistem Informasi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jurusans')->insert([
            'nama' => 'S1 Akuntansi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jurusans')->insert([
            'nama' => 'S1 Ekonomi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jurusans')->insert([
            'nama' => 'S1 Hubungan Internasional',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jurusans')->insert([
            'nama' => 'S1 Ilmu Pemerintahan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jurusans')->insert([
            'nama' => 'S1 Kewirausahaan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jurusans')->insert([
            'nama' => 'S1 Arsitektur',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jurusans')->insert([
            'nama' => 'S1 Geografi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jurusans')->insert([
            'nama' => 'S1 Perencanaan Wilayah Dan Kota',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
