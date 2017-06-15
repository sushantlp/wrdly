<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('city_lists')->insert(array(
           array('state_id'=> 35 ,'city_name'=> 'Kolkata' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 2 ,'city_name'=> 'Hyderabad' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 4 ,'city_name'=> 'Guwahati' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 5 ,'city_name'=> 'Patna' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 12 ,'city_name'=> 'Chandigarh' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 6 ,'city_name'=> 'Raipur' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 20 ,'city_name'=> 'Mumbai' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 9 ,'city_name'=> 'New Delhi' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 11 ,'city_name'=> 'Ahmedabad' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 16 ,'city_name'=> 'Bengaluru' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 17 ,'city_name'=> 'Kochi' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 30 ,'city_name'=> 'Chennai' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 33 ,'city_name'=> 'Lucknow' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 28 ,'city_name'=> 'Jaipur' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 26 ,'city_name'=> 'Puducherry' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_id'=> 27 ,'city_name'=> 'Chandigarh' ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
        ));
    }
}
