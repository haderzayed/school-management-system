<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();
        $genders=[
            ['en'=>'male','ar'=>'ذكر'],
            ['en'=>'female','ar'=>'أنثى'],
        ];
        foreach ($genders as $gender){

            \App\Models\gender::create(['name'=>$gender]);
        }
    }
}
