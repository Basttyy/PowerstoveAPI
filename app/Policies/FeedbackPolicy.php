<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedbackPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any feedback.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the feedback.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feedback  $feedback
     * @return mixed
     */
    public function view(User $user, Feedback $feedback)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create feedback.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the feedback.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feedback  $feedback
     * @return mixed
     */
    public function update(User $user, Feedback $feedback)
    {
        return $user->id === $feedback->user_id
            ? Resposne::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can delete the feedback.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feedback  $feedback
     * @return mixed
     */
    public function delete(User $user, Feedback $feedback)
    {
        return $user->id === $feedback->user_id
            ? Resposne::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can restore the feedback.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feedback  $feedback
     * @return mixed
     */
    public function restore(User $user, Feedback $feedback)
    {
        return $user->id === $feedback->user_id
            ? Resposne::allow()
            : Response::deny('You are not Authorized for this operation');
    }

    /**
     * Determine whether the user can permanently delete the feedback.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feedback  $feedback
     * @return mixed
     */
    public function forceDelete(User $user, Feedback $feedback)
    {
        return $user->id === $feedback->user_id
            ? Resposne::allow()
            : Response::deny('You are not Authorized for this operation');
    }
}
