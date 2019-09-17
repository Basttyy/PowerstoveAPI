<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Agent;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgentPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any agents.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return true;
    }

    /**
     * Determine whether the user can view the agent.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Agent  $agent
     * @return mixed
     */
    public function view($admin, Agent $agent)
    {
        return ($admin->admin === null)||($admin->id === $agent->admin_id)||($admin->id === $agent->id)
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can create agents.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $admin->admin != null
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }
    /**
     * Determine whether the user can update the agent.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Agent  $agent
     * @return mixed
     */
    public function update(Admin $admin, Agent $agent)
    {
        return $admin->id === $agent->admin_id
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can delete the agent.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Agent  $agent
     * @return mixed
     */
    public function delete(Admin $admin, Agent $agent)
    {
        return ($admin->id === $agent->admin_id)||($admin->admin === null)
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can restore the agent.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Agent  $agent
     * @return mixed
     */
    public function restore(Admin $admin, Agent $agent)
    {
        return ($admin->id === $agent->admin_id)||($admin->admin === null)
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can permanently delete the agent.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Agent  $agent
     * @return mixed
     */
    public function forceDelete(Admin $admin, Agent $agent)
    {
        return ($admin->id === $agent->admin_id)||($admin->admin === null)
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }
}
