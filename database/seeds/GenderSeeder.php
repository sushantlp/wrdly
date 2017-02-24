<?php

use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->insert(array(
           array('name'=>'Male','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('name'=>'Female','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
       ));
    }
}
