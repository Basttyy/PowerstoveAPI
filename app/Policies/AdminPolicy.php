<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any admins.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $amdin)
    {
        return $admin->admin == null
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can view the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function view(Admin $admin1, Admin $admin2)
    {
        return ($admin1->admin === null)||($admin1->id === $admin2->id)
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can create admins.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin1)
    {
        return $admin1->admin === null
            ? Response::allow()
            : Response::deny('You are not Authorized to create admin');
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function update(Admin $admin1, Admin $admin2)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function delete(Admin $admin1, Admin $admin2)
    {
        return ($admin1->admin === null)&&($admin2->admin != null)
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can restore the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function restore(Admin $admin1, Admin $admin2)
    {
        return ($admin1->admin === null)&&($admin2->admin != null)
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can permanently delete the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function forceDelete(Admin $admin1, Admin $admin2)
    {
        return ($admin1->admin === null)&&($admin2->admin != null)
            ? Response::allow()
            : Response::deny('You are not Authorized for this operation');
    }
}
