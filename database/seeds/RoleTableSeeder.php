<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create super admin role
        $role_super_admin = new Role();
        $role_super_admin->name = 'super_admin';
        $role_super_admin->description = 'super admin user role';
        $role_super_admin->save();
                
        //create admin role
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'admin user role';
        $role_admin->save();

        //create agent role
        $role_agent = new Role();
        $role_agent->name = 'agent';
        $role_agent->description = 'agent user role';
        $role_agent->save();

        //create user role
        $role_customer = new Role();
        $role_customer->name = 'customer';
        $role_customer->description = 'stove user role';
        $role_customer->save();
    }
}
