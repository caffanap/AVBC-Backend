<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for ($i = 0; $i < 5; $i++) {
            DB::table('masukans')->insert([
                'user_id' => $faker->numberBetween(2, 5),
                'pesan' => 'Pesan ' . ($i + 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
