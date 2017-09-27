<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wt_company')->insert([
            'name' => 'ofirLtd',
            'email' => 'ofirs1988@gmail.com',
            'contact_name' => 'ofir',
            'phone' => '0526888119',
            'logo' => 'https://image.freepik.com/free-vector/abstract-logo-in-flame-shape_1043-44.jpg',
            'active' => 1,
            'type' => 1,
            'op' => 269874,
            'type_pay' => 1,
            'site' => 'http://46.101.194.126/vmClient/admin',
            'social_page' => 'https://www.facebook.com/ofir.shurdeker',

        ]);
    }
}
