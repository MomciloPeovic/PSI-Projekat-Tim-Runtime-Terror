<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->insert([
            'email' => 'nikola' . '@gmail.com',
            'name' => 'Nikola',
            'surname' => 'Babic',
            'gender' => 'Musko',
            'birth_date' => date("Y-m-d"),
            'rating' => '100',
            'password' => bcrypt('ja123')
        ]);
        DB::table('players')->insert([
            'email' => 'dedpul' . '@gmail.com',
            'name' => 'Dedpul',
            'surname' => 'Cubrilo',
            'gender' => 'Musko',
            'birth_date' => date("Y-m-d"),
            'rating' => '300',
            'password' => bcrypt('ja123')
        ]);
    
    
    }
}
