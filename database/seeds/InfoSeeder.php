<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for ($i = 0; $i < 5; $i++) {
            DB::table('infos')->insert([
                'angkatan_id' => $faker->numberBetween(1, 5),
                'judul' => 'Judul ' . ($i + 1),
                'deskripsi' => 'Deskripsi ' . ($i + 1),
                'lokasi' => $faker->address,
                'jadwal' => $faker->dateTime,
                'ketentuan' => 'Ketentuan '. ($i + 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
