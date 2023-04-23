<?php

namespace App\Policies;

use App\Models\User;
use App\Models\cpayments;
use Illuminate\Auth\Access\HandlesAuthorization;

class CpaymentsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\cpayments  $cpayments
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, cpayments $cpayments)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\cpayments  $cpayments
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, cpayments $cpayments)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\cpayments  $cpayments
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, cpayments $cpayments)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\cpayments  $cpayments
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, cpayments $cpayments)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\cpayments  $cpayments
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, cpayments $cpayments)
    {
        //
    }
}
