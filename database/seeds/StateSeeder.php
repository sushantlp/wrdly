<?php

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('state_lists')->insert(array(
           array('state_name'=> 'Andaman and Nicobar Islands' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Andhra Pradesh' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Arunachal Pradesh' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Assam' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Bihar' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Chhattisgarh' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Dadra and Nagar Haveli' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Daman and Diu' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Delhi' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Goa' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Gujarat' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Haryana' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Himachal Pradesh' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Jammu and Kashmir' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Jharkhand' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Karnataka' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Kerala' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Lakshadweep' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Madhya Pradesh' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Maharashtra' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Manipur' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Meghalaya' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Mizoram' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Nagaland' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Odisha' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Puducherry' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Punjab' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Rajasthan' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Sikkim' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Tamil Nadu' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Telangana' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Tripura' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Uttar Pradesh' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'Uttarakhand' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('state_name'=> 'West Bengal' ,'country_id'=> 1 ,'created_at'=>\Carbon\Carbon::now()->toDateTimeString() ,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
        ));
    }
}
