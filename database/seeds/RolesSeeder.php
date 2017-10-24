<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $anonymous = \App\Role::create([
            'name' => 'Anonymous',
            'slug' => 'anonymous',
            'default_permissions' => json_encode([
                'watching' => true,
                'advertiser' => false,
            ])
        ]);


        $block = \App\Role::create([
            'name' => 'Block',
            'slug' => 'block',
            'default_permissions' => json_encode([
                'watching' => false,
                'advertiser' => false,
            ])
        ]);

        $administrator = \App\Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
            'default_permissions' => json_encode([
                'all-draft' => true,
            ])
        ]);

        $advertiser = \App\Role::create([
            'name' => 'Advertiser',
            'slug' => 'advertiser',
            'default_permissions' => json_encode([
                'watching' => true,
                'advertiser' => true,
                'create-video' => true,
                'edit-video' => true,
                'edit-campaign' => true,
                'create-campaign' => true,
                'edit-user' => true,
                'create-user' => true,
            ])
        ]);
    }
}
