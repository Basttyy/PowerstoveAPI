<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Admin' => 'App\Policies\AdminPolicy',
        'App\Models\Agent' => 'App\Policies\AgentPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Stove' => 'App\Policies\StovePolicy',
        'App\Models\Payment' => 'App\Policies\PaymentPolicy',
        'App\Models\Feedback' => 'App\Policies\FeedbackPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Auth::routes(['verify' => true]);
    }
}
