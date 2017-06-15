<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert(array(
           array('country_name'=> 'India','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString())
        ));
    }
}
