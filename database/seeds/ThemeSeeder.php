<?php

use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('themes')->insert(array(
           array('theme_name'=>'story','comment'=>'','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('theme_name'=>'poem','comment'=>'','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('theme_name'=>'lyrics','comment'=>'','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('theme_name'=>'comedy','comment'=>'','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('theme_name'=>'drama','comment'=>'','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('theme_name'=>'sci-fi','comment'=>'','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
       ));
    }
}
