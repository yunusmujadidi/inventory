<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Posisi;
use Illuminate\Auth\Access\HandlesAuthorization;

class PosisiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the posisi can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list posisis');
    }

    /**
     * Determine whether the posisi can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Posisi  $model
     * @return mixed
     */
    public function view(User $user, Posisi $model)
    {
        return $user->hasPermissionTo('view posisis');
    }

    /**
     * Determine whether the posisi can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create posisis');
    }

    /**
     * Determine whether the posisi can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Posisi  $model
     * @return mixed
     */
    public function update(User $user, Posisi $model)
    {
        return $user->hasPermissionTo('update posisis');
    }

    /**
     * Determine whether the posisi can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Posisi  $model
     * @return mixed
     */
    public function delete(User $user, Posisi $model)
    {
        return $user->hasPermissionTo('delete posisis');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Posisi  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete posisis');
    }

    /**
     * Determine whether the posisi can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Posisi  $model
     * @return mixed
     */
    public function restore(User $user, Posisi $model)
    {
        return false;
    }

    /**
     * Determine whether the posisi can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Posisi  $model
     * @return mixed
     */
    public function forceDelete(User $user, Posisi $model)
    {
        return false;
    }
}
