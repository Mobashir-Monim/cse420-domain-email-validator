<?php

use Illuminate\Database\Seeder;

class DigitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

        foreach ($digits as $digit) {
            DB::table('digits')->insert([
                'value' => $digit,
            ]);
        }
    }
}
