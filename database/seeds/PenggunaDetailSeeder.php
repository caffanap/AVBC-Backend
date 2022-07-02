<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        //
        for ($i=1; $i < 21; $i++) { 
            DB::table('pengguna_details')->insert([
                'user_id' => ($i+1),
                'angkatan_id' => $faker->numberBetween(1, 5),
                'alamat' => $faker->address,
                'jenis_kelamin' => $faker->boolean ? 'Laki-Laki' : 'Perempuan',
                'jurusan_id' => $faker->numberBetween(1, 5),
                'nim' => $faker->swiftBicNumber,
                'posisi_id' => $faker->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
