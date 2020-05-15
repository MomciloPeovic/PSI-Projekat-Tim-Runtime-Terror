<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tournaments')->insert([
            'name' => 'turnir',
            'email' => 'email' . '@gmail.com',
            'phone' => '12345678',
            'start_date' => date("Y-m-d"),
            'end_date' => date("Y-m-d"),
            'time' => date("H:i:s"),
            'place' => 'beograd',
            'rounds' => 5,
            'type' => 'player'
        ]);

        DB::table('tournaments')->insert([
            'name' => 'turnir2',
            'email' => 'email2' . '@gmail.com',
            'phone' => '12345678',
            'start_date' => date("Y-m-d"),
            'end_date' => date("Y-m-d"),
            'time' => date("H:i:s"),
            'place' => 'novi sad',
            'rounds' => 7,
            'type' => 'club'
        ]);
    }
}
