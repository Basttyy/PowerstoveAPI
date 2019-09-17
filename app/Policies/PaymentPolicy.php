<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any payments.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the payment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function view(User $user, Payment $payment)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create payments.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the payment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function update(User $user, Payment $payment)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can delete the payment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function delete(User $user, Payment $payment)
    {
        return Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can restore the payment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function restore(User $user, Payment $payment)
    {
        return Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can permanently delete the payment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function forceDelete(User $user, Payment $payment)
    {
        return Response::deny('You are not Authorized for this operation');
    }
}
