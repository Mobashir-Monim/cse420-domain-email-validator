<?php

use Illuminate\Database\Seeder;

class SpecialCharsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('special_chars')->insert([
            'value' => '-',
            'type' => 'web'
        ]);

        DB::table('special_chars')->insert([
            'value' => '.',
            'type' => 'web'
        ]);

        DB::table('special_chars')->insert([
            'value' => '_',
            'type' => 'email'
        ]);

        DB::table('special_chars')->insert([
            'value' => '.',
            'type' => 'email'
        ]);
    }
}
