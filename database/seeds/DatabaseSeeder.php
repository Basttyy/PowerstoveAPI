<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // seed the roles table
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
