<?php

use Illuminate\Database\Seeder;

class RolesUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wt_role_users')->insert([

        ]);

        DB::table('wt_role_users')->insert([
            'user_id' => 1,
            'role_id' => 3,
        ]);
    }
}
