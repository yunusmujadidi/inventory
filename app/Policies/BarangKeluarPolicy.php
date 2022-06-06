<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BarangKeluar;
use Illuminate\Auth\Access\HandlesAuthorization;

class BarangKeluarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the barangKeluar can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list barangkeluars');
    }

    /**
     * Determine whether the barangKeluar can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BarangKeluar  $model
     * @return mixed
     */
    public function view(User $user, BarangKeluar $model)
    {
        return $user->hasPermissionTo('view barangkeluars');
    }

    /**
     * Determine whether the barangKeluar can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create barangkeluars');
    }

    /**
     * Determine whether the barangKeluar can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BarangKeluar  $model
     * @return mixed
     */
    public function update(User $user, BarangKeluar $model)
    {
        return $user->hasPermissionTo('update barangkeluars');
    }

    /**
     * Determine whether the barangKeluar can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BarangKeluar  $model
     * @return mixed
     */
    public function delete(User $user, BarangKeluar $model)
    {
        return $user->hasPermissionTo('delete barangkeluars');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BarangKeluar  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete barangkeluars');
    }

    /**
     * Determine whether the barangKeluar can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BarangKeluar  $model
     * @return mixed
     */
    public function restore(User $user, BarangKeluar $model)
    {
        return false;
    }

    /**
     * Determine whether the barangKeluar can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BarangKeluar  $model
     * @return mixed
     */
    public function forceDelete(User $user, BarangKeluar $model)
    {
        return false;
    }
}
