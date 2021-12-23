<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bloods')->delete();
         $bloods=['O-','O+','A-','A+','B-','B+','AB-','AB+'];

         foreach ($bloods as $blood){

             \App\Models\blood::create(['name'=>$blood]);
         }
    }
}
