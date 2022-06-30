<?php

namespace App\Http\Controllers\Api;

use App\Models\Genres;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MoviesResource;
use App\Http\Resources\MoviesCollection;

class GenresAllMoviesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Genres $genres
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Genres $genres)
    {
        $this->authorize('view', $genres);

        $search = $request->get('search', '');

        $allMovies = $genres
            ->allMovies()
            ->search($search)
            ->latest()
            ->paginate();

        return new MoviesCollection($allMovies);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Genres $genres
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Genres $genres)
    {
        $this->authorize('create', Movies::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'date' => ['required', 'date'],
        ]);

        $movies = $genres->allMovies()->create($validated);

        return new MoviesResource($movies);
    }
}
