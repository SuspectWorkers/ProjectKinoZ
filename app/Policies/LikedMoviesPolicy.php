<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LikedMovies;
use Illuminate\Auth\Access\HandlesAuthorization;

class LikedMoviesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the likedMovies can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isEditor();
    }

    /**
     * Determine whether the likedMovies can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LikedMovies  $model
     * @return mixed
     */
    public function view(User $user, LikedMovies $model)
    {
        return true;
    }

    /**
     * Determine whether the likedMovies can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the likedMovies can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LikedMovies  $model
     * @return mixed
     */
    public function update(User $user, LikedMovies $model)
    {
        return $user->isEditor();
    }

    /**
     * Determine whether the likedMovies can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LikedMovies  $model
     * @return mixed
     */
    public function delete(User $user, LikedMovies $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LikedMovies  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->isEditor();
    }

    /**
     * Determine whether the likedMovies can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LikedMovies  $model
     * @return mixed
     */
    public function restore(User $user, LikedMovies $model)
    {
        return false;
    }

    /**
     * Determine whether the likedMovies can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LikedMovies  $model
     * @return mixed
     */
    public function forceDelete(User $user, LikedMovies $model)
    {
        return false;
    }
}
