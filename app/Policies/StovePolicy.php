<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Stove;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class StovePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any stoves.
     *
     * @param  $user
     * @return mixed
     */
    public function viewAny($user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the stove.
     *
     * @param  $user
     * @param  \App\Models\Stove  $stove
     * @return mixed
     */
    public function view($user, Stove $stove)
    {
        return true;
    }

    /**
     * Determine whether the user can create stoves.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $admin->admin === null
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can update the stove.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Stove  $stove
     * @return mixed
     */
    public function update(Admin $admin, Stove $stove)
    {
        return $admin->admin === null
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can delete the stove.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Stove  $stove
     * @return mixed
     */
    public function delete(Admin $admin, Stove $stove)
    {
        return $admin->admin === null
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can restore the stove.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Stove  $stove
     * @return mixed
     */
    public function restore(Admin $admin, Stove $stove)
    {
        return $admin->admin === null
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can permanently delete the stove.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Stove  $stove
     * @return mixed
     */
    public function forceDelete(Admin $admin, Stove $stove)
    {
        return $admin->admin === null
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }
}
