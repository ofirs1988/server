<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wt_users')->insert([
            'name' => 'אופיר שורדקר',
            'email' => 'ofirs1988@gmail.com',
            'avatar' => 'https://scontent.fhfa1-1.fna.fbcdn.net/v/t1.0-1/p40x40/13254277_10206262211300543_8837798251225654522_n.jpg?oh=0b5ca319d30af79a3f17ad580c48c037&oe=5A3DF621',
            'password' => \Illuminate\Support\Facades\Hash::make('secret'),
            'phone' => '0526888119',
            'active' => 1,
            'fid' => 10209943005158089,
            'gid' => null,
            'type' => 1,
        ]);
    }
}
