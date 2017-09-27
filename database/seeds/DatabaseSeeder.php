    <?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(CompanyUsersTableSeeder::class);
        $this->call(UserInfoTableSeeder::class);
        $this->call(RolesUsersTableSeeder::class);
    }
}
