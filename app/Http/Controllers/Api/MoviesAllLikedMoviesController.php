<?php

namespace App\Http\Controllers\Api;

use App\Models\Movies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LikedMoviesResource;
use App\Http\Resources\LikedMoviesCollection;

class MoviesAllLikedMoviesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movies $movies
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Movies $movies)
    {
        $this->authorize('view', $movies);

        $search = $request->get('search', '');

        $allLikedMovies = $movies
            ->allLikedMovies()
            ->search($search)
            ->latest()
            ->paginate();

        return new LikedMoviesCollection($allLikedMovies);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movies $movies
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Movies $movies)
    {
        $this->authorize('create', LikedMovies::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $likedMovies = $movies->allLikedMovies()->create($validated);

        return new LikedMoviesResource($likedMovies);
    }
}
