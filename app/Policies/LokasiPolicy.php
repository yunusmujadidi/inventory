<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Lokasi;
use Illuminate\Auth\Access\HandlesAuthorization;

class LokasiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the lokasi can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list lokasis');
    }

    /**
     * Determine whether the lokasi can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Lokasi  $model
     * @return mixed
     */
    public function view(User $user, Lokasi $model)
    {
        return $user->hasPermissionTo('view lokasis');
    }

    /**
     * Determine whether the lokasi can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create lokasis');
    }

    /**
     * Determine whether the lokasi can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Lokasi  $model
     * @return mixed
     */
    public function update(User $user, Lokasi $model)
    {
        return $user->hasPermissionTo('update lokasis');
    }

    /**
     * Determine whether the lokasi can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Lokasi  $model
     * @return mixed
     */
    public function delete(User $user, Lokasi $model)
    {
        return $user->hasPermissionTo('delete lokasis');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Lokasi  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete lokasis');
    }

    /**
     * Determine whether the lokasi can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Lokasi  $model
     * @return mixed
     */
    public function restore(User $user, Lokasi $model)
    {
        return false;
    }

    /**
     * Determine whether the lokasi can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Lokasi  $model
     * @return mixed
     */
    public function forceDelete(User $user, Lokasi $model)
    {
        return false;
    }
}
