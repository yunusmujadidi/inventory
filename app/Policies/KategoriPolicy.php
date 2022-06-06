<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Auth\Access\HandlesAuthorization;

class KategoriPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the kategori can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list kategoris');
    }

    /**
     * Determine whether the kategori can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Kategori  $model
     * @return mixed
     */
    public function view(User $user, Kategori $model)
    {
        return $user->hasPermissionTo('view kategoris');
    }

    /**
     * Determine whether the kategori can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create kategoris');
    }

    /**
     * Determine whether the kategori can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Kategori  $model
     * @return mixed
     */
    public function update(User $user, Kategori $model)
    {
        return $user->hasPermissionTo('update kategoris');
    }

    /**
     * Determine whether the kategori can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Kategori  $model
     * @return mixed
     */
    public function delete(User $user, Kategori $model)
    {
        return $user->hasPermissionTo('delete kategoris');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Kategori  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete kategoris');
    }

    /**
     * Determine whether the kategori can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Kategori  $model
     * @return mixed
     */
    public function restore(User $user, Kategori $model)
    {
        return false;
    }

    /**
     * Determine whether the kategori can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Kategori  $model
     * @return mixed
     */
    public function forceDelete(User $user, Kategori $model)
    {
        return false;
    }
}
