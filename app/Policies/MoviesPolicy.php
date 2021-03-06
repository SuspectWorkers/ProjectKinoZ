<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Movies;
use Illuminate\Auth\Access\HandlesAuthorization;

class MoviesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the movies can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isEditor();
    }

    /**
     * Determine whether the movies can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Movies  $model
     * @return mixed
     */
    public function view(User $user, Movies $model)
    {
        return true;
    }

    /**
     * Determine whether the movies can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isEditor();
    }

    /**
     * Determine whether the movies can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Movies  $model
     * @return mixed
     */
    public function update(User $user, Movies $model)
    {
        return $user->isEditor();
    }

    /**
     * Determine whether the movies can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Movies  $model
     * @return mixed
     */
    public function delete(User $user, Movies $model)
    {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Movies  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->isEditor();
    }

    /**
     * Determine whether the movies can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Movies  $model
     * @return mixed
     */
    public function restore(User $user, Movies $model)
    {
        return false;
    }

    /**
     * Determine whether the movies can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Movies  $model
     * @return mixed
     */
    public function forceDelete(User $user, Movies $model)
    {
        return false;
    }
}
