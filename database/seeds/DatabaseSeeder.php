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
         $this->call(BloodSeeder::class);
        $this->call(NationalSeeder::class);
        $this->call(ReligionSeeder::class);


    }
}
