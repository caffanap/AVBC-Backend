<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(AngkatanSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(InfoSeeder::class);
        $this->call(JurusanSeeder::class);
        $this->call(MasukanSeeder::class);
        $this->call(PendaftaranSeeder::class);
        $this->call(PosisiSeeder::class);
        $this->call(PenggunaDetailSeeder::class);
    }
}
