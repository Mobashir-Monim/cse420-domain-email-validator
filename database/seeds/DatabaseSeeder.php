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
        $this->call([
            AlphabetsTableSeeder::class,
            DigitsTableSeeder::class,
            SpecialCharsTableSeeder::class,
            TLDTableSeeder::class
        ]);
    }
}
