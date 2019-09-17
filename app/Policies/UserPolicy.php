<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Agent;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the model can view any user.
     *
     * @param $user
     * @return mixed
     */
    public function viewAny($model)
    {
        return true;
    }

    /**
     * Determine whether the model can view the user.
     *
     * @param  $model
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function view($model, User $user)
    {
        return ($model->id === $user->agent_id)||($model->id === $user->id)||($model->admin === null)
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the model can create users.
     *
     * @param  \App\Models\Agent $Agent
     * @return mixed
     */
    public function create(Agent $agent)
    {
        return $agent->admin_id != null
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User $model
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $model, User $user)
    {
        return $model->id === $user->id
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the admin can delete the user.
     *
     * @param  \App\Models\Admin $admin
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function delete(Admin $model, User $user)
    {
        return ($model->id === App\Models\Admin::find($user->agent_id))->id()||($model->admin === null)
        ? Response::allow()
        : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the admin can restore the user.
     *
     * @param  \App\Models\Admin $admin
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function restore(Admin $admin, User $user)
    {
        return ($model->id === App\Models\Admin::find($user->agent_id))->id()||($model->admin === null)
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin $admin
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function forceDelete(Admin $admin, User $user)
    {
        return ($model->id === App\Models\Admin::find($user->agent_id))->id()||($model->admin === null)
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }
}
