<?php

use Illuminate\Database\Seeder;

class UserInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wt_usersinfo')->insert([
            'user_id' => 1,
            'birthday' => '17/10/1988',
            'age' => 28,
            'city' => 'petah tikva',
            'address' => 'ahva 14',
            'hometown' => null,
            'education' => null,
            'gender' => 'male',
            'website' => null,
            'work' => 'home',
        ]);
    }
}
