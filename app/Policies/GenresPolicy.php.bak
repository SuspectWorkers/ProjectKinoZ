<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Genres;
use Illuminate\Auth\Access\HandlesAuthorization;

class GenresPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the genres can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the genres can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Genres  $model
     * @return mixed
     */
    public function view(User $user, Genres $model)
    {
        return true;
    }

    /**
     * Determine whether the genres can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the genres can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Genres  $model
     * @return mixed
     */
    public function update(User $user, Genres $model)
    {
        return true;
    }

    /**
     * Determine whether the genres can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Genres  $model
     * @return mixed
     */
    public function delete(User $user, Genres $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Genres  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the genres can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Genres  $model
     * @return mixed
     */
    public function restore(User $user, Genres $model)
    {
        return false;
    }

    /**
     * Determine whether the genres can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Genres  $model
     * @return mixed
     */
    public function forceDelete(User $user, Genres $model)
    {
        return false;
    }
}
