<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ThemeSeeder::class);
         $this->call(DaySeeder::class);
         $this->call(GenderSeeder::class);
         $this->call(QuoteSeeder::class);
    }
}
