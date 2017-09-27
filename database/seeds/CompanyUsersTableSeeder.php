<?php

use Illuminate\Database\Seeder;

class CompanyUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wt_company_users')->insert([
            'company_id' => 1,
            'user_id' => 1,
        ]);
    }
}
