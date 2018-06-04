<?php

namespace App\Policies;

use App\User;
use App\LoadOrder;
use Illuminate\Auth\Access\HandlesAuthorization;

class LoadOrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the load order.
     *
     * @param  \App\User  $user
     * @param  \App\LoadOrder  $loadOrder
     * @return mixed
     */
    public function view(User $user, LoadOrder $loadOrder)
    {
        //
    }

    /**
     * Determine whether the user can create load orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the load order.
     *
     * @param  \App\User  $user
     * @param  \App\LoadOrder  $loadOrder
     * @return mixed
     */
    public function update(User $user, LoadOrder $loadOrder)
    {
		return $user->id === $loadOrder->user_id;
    }

    /**
     * Determine whether the user can delete the load order.
     *
     * @param  \App\User  $user
     * @param  \App\LoadOrder  $loadOrder
     * @return mixed
     */
    public function delete(User $user, LoadOrder $loadOrder)
    {
        return $user->id === $loadOrder->user_id;
    }
}
