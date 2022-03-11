<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for ($i = 0; $i < 5; $i++) {
            DB::table('pendaftarans')->insert([
                'angkatan_id' => $faker->numberBetween(2, 5),
                'judul' => 'Judul ' . ($i + 1),
                'deskripsi' => 'Deskripsi ' . ($i + 1),
                'tanggal_buka' => now(),
                'tanggal_tutup' => now(),
                'link_wa' => 'link wa ' . ($i + 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
