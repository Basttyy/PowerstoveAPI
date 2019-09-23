<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed the user table with super admins
        factory(App\Models\User::class, 3)->create()->each(function ($user){
            $user->roles()->attach(App\Models\Role::where('name', 'super_admin')->first());
            $user->agent_id = 1; $user->admin_id = 1;
            $user->save();
        });
        // seed the user table with admins
        factory(App\Models\User::class, 9)->create()->each(function ($user){
            $user->roles()->attach(App\Models\Role::where('name', 'admin')->first());
            $user->agent_id = User::where('id', '<=', 3)->orderBy('id', 'desc')->get()->random()->id; $user->admin_id = 1;
            $user->save();
        });
        // seed the user table with agents
        factory(App\Models\User::class, 27)->create()->each(function ($user){
            $id = User::where('id', '<=', 12)->where('id', '>', 3)->orderBy('id', 'desc')->get()->random()->id;
            $user->roles()->attach(App\Models\Role::where('name', 'agent')->first());
            $user->agent_id = $id;
            $user->admin_id = User::findOrFail($id)->agent_id;
            $user->save();
        });
        // seed the user table with customers
        factory(App\Models\User::class, 81)->create()->each(function ($user){
            $id = User::where('id', '<=', 39)->where('id', '>', 12)->orderBy('id', 'desc')->get()->random()->id;
            $user->roles()->attach(App\Models\Role::where('name', 'customer')->first());
            $user->agent_id = $id;
            $user->admin_id = User::findOrFail($id)->agent_id;
            $user->save();
        });
    }
}
