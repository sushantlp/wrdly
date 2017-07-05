<?php

use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quotes')->insert(array(
           array('quote_of_day'=>'A word after a word after a word is power','writer_name'=>'Margaret Atwood','day_id'=>'1','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('quote_of_day'=>'A word after a word after a word is power','writer_name'=>'Margaret Atwood','day_id'=>'2','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('quote_of_day'=>'A word after a word after a word is power','writer_name'=>'Margaret Atwood','day_id'=>'3','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('quote_of_day'=>'A word after a word after a word is power','writer_name'=>'Margaret Atwood','day_id'=>'4','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('quote_of_day'=>'A word after a word after a word is power','writer_name'=>'Margaret Atwood','day_id'=>'5','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
           array('quote_of_day'=>'A word after a word after a word is power','writer_name'=>'Margaret Atwood','day_id'=>'6','created_at'=>\Carbon\Carbon::now()->toDateTimeString(),'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()),
       ));
    }
}
