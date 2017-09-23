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
            'permissions' => json_encode([
                'watching' => true,
            ])
        ]);


        $block = \App\Role::create([
            'name' => 'Block',
            'slug' => 'block',
            'permissions' => json_encode([
                'watching' => false,
            ])
        ]);

        $admin = \App\Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
            'permissions' => json_encode([
                'all-draft' => true,
            ])
        ]);

        $author = \App\Role::create([
            'name' => 'Author',
            'slug' => 'author',
            'permissions' => json_encode([
                'watching' => true,
                'Advertiser' => true,
                'create-video' => true,
                'edit-video' => true,
                'edit-campaign' => true,
            ])
        ]);

        $editor = \App\Role::create([
            'name' => 'Editor',
            'slug' => 'editor',
            'permissions' => json_encode([
                'watching' => true,
                'Advertiser' => true,
                'create-video' => true,
                'edit-video' => true,
                'publish-video' => true,
                'create-campaign' => true,
                'edit-campaign' => true,
            ])
        ]);
    }
}
