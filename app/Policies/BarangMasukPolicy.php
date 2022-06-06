<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BarangMasuk;
use Illuminate\Auth\Access\HandlesAuthorization;

class BarangMasukPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the barangMasuk can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list barangmasuks');
    }

    /**
     * Determine whether the barangMasuk can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BarangMasuk  $model
     * @return mixed
     */
    public function view(User $user, BarangMasuk $model)
    {
        return $user->hasPermissionTo('view barangmasuks');
    }

    /**
     * Determine whether the barangMasuk can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create barangmasuks');
    }

    /**
     * Determine whether the barangMasuk can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BarangMasuk  $model
     * @return mixed
     */
    public function update(User $user, BarangMasuk $model)
    {
        return $user->hasPermissionTo('update barangmasuks');
    }

    /**
     * Determine whether the barangMasuk can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BarangMasuk  $model
     * @return mixed
     */
    public function delete(User $user, BarangMasuk $model)
    {
        return $user->hasPermissionTo('delete barangmasuks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BarangMasuk  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete barangmasuks');
    }

    /**
     * Determine whether the barangMasuk can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BarangMasuk  $model
     * @return mixed
     */
    public function restore(User $user, BarangMasuk $model)
    {
        return false;
    }

    /**
     * Determine whether the barangMasuk can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BarangMasuk  $model
     * @return mixed
     */
    public function forceDelete(User $user, BarangMasuk $model)
    {
        return false;
    }
}
