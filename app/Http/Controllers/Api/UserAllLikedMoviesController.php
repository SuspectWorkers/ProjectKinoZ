<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LikedMoviesResource;
use App\Http\Resources\LikedMoviesCollection;

class UserAllLikedMoviesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $allLikedMovies = $user
            ->allLikedMovies()
            ->search($search)
            ->latest()
            ->paginate();

        return new LikedMoviesCollection($allLikedMovies);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', LikedMovies::class);

        $validated = $request->validate([
            'movies_id' => ['required', 'exists:movies,id'],
        ]);

        $likedMovies = $user->allLikedMovies()->create($validated);

        return new LikedMoviesResource($likedMovies);
    }
}
