<?php

use Illuminate\Database\Seeder;

class AlphabetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ABCDEFGHIJKLMNOPQRSTUVWXYZ
        $alphabets = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
        
        foreach ($alphabets as $letter) {
            DB::table('alphabets')->insert([
                'value' => $letter,
            ]);
        }
    }
}
