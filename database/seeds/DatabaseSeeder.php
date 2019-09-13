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
        factory(App\Models\Admin::class, 3)->create()->each(function ($admin){
            //seed the relation with five agent data
            $agents = factory(App\Models\Agent::class, 5)->make();
            $admin->agents()->saveMany($agents)->each(function ($agent){
                //seed the relation with five user data
                $users = factory(App\Models\User::class, 5)->make();
                $agent->users()->saveMany($users)->each(function ($user){
                    //seed the relation with five user data
                    $stoves = factory(App\Models\Stove::class, 5)->make();
                    $user->stoves()->saveMany($stoves);
                });
            });
        });
    }
}
