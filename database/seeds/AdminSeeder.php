<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        //
        DB::table('users')->insert([
            'name' => 'AVBC ADMIN',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($i=0; $i < 20; $i++) { 
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('12345678'),
                'no_telp' => $faker->phoneNumber,
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
