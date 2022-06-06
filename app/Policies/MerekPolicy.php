<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Merek;
use Illuminate\Auth\Access\HandlesAuthorization;

class MerekPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the merek can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list mereks');
    }

    /**
     * Determine whether the merek can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Merek  $model
     * @return mixed
     */
    public function view(User $user, Merek $model)
    {
        return $user->hasPermissionTo('view mereks');
    }

    /**
     * Determine whether the merek can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create mereks');
    }

    /**
     * Determine whether the merek can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Merek  $model
     * @return mixed
     */
    public function update(User $user, Merek $model)
    {
        return $user->hasPermissionTo('update mereks');
    }

    /**
     * Determine whether the merek can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Merek  $model
     * @return mixed
     */
    public function delete(User $user, Merek $model)
    {
        return $user->hasPermissionTo('delete mereks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Merek  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete mereks');
    }

    /**
     * Determine whether the merek can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Merek  $model
     * @return mixed
     */
    public function restore(User $user, Merek $model)
    {
        return false;
    }

    /**
     * Determine whether the merek can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Merek  $model
     * @return mixed
     */
    public function forceDelete(User $user, Merek $model)
    {
        return false;
    }
}
