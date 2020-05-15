<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clubs')->insert([
            'name' => 'Sampioni',
            'email' => 'sampioni' . '@gmail.com',
            'password' => bcrypt('klub123'),
            'founded' => date("Y-m-d"),
            'address' => 'Ulica u Beograd 15',
            'phone' => '062047265'
        ]);
        DB::table('clubs')->insert([
            'name' => 'Veverice',
            'email' => 'veverice' . '@gmail.com',
            'password' => bcrypt('klub123'),
            'founded' => date("Y-m-d"),
            'address' => 'Ulica u Beograd 17',
            'phone' => '063440212'
        ]);
        DB::table('clubs')->insert([
            'name' => 'Bagra',
            'email' => 'bagra' . '@gmail.com',
            'password' => bcrypt('klub123'),
            'founded' => date("Y-m-d"),
            'address' => 'Ulica u Beograd 1',
            'phone' => '065608293'
        ]);
        DB::table('clubs')->insert([
            'name' => 'Majstori',
            'email' => 'majstori' . '@gmail.com',
            'password' => bcrypt('klub123'),
            'founded' => date("Y-m-d"),
            'address' => 'Ulica u Beograd 25',
            'phone' => '061239485'
        ]);
        DB::table('clubs')->insert([
            'name' => 'Bubamara',
            'email' => 'bubamara' . '@gmail.com',
            'password' => bcrypt('klub123'),
            'founded' => date("Y-m-d"),
            'address' => 'Ulica u Beograd 67',
            'phone' => '064902061'
        ]);
        DB::table('clubs')->insert([
            'name' => 'Drvored',
            'email' => 'drvored' . '@gmail.com',
            'password' => bcrypt('klub123'),
            'founded' => date("Y-m-d"),
            'address' => 'Ulica u Beograd 45',
            'phone' => '060817356'
        ]);
    }
}
