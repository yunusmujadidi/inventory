<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Auth\Access\HandlesAuthorization;

class BarangPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the barang can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list barangs');
    }

    /**
     * Determine whether the barang can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Barang  $model
     * @return mixed
     */
    public function view(User $user, Barang $model)
    {
        return $user->hasPermissionTo('view barangs');
    }

    /**
     * Determine whether the barang can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create barangs');
    }

    /**
     * Determine whether the barang can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Barang  $model
     * @return mixed
     */
    public function update(User $user, Barang $model)
    {
        return $user->hasPermissionTo('update barangs');
    }

    /**
     * Determine whether the barang can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Barang  $model
     * @return mixed
     */
    public function delete(User $user, Barang $model)
    {
        return $user->hasPermissionTo('delete barangs');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Barang  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete barangs');
    }

    /**
     * Determine whether the barang can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Barang  $model
     * @return mixed
     */
    public function restore(User $user, Barang $model)
    {
        return false;
    }

    /**
     * Determine whether the barang can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Barang  $model
     * @return mixed
     */
    public function forceDelete(User $user, Barang $model)
    {
        return false;
    }
}
