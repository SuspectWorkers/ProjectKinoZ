<?php

namespace App\Http\Controllers\Api;

use App\Models\Movies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MoviesResource;
use App\Http\Resources\MoviesCollection;
use App\Http\Requests\MoviesStoreRequest;
use App\Http\Requests\MoviesUpdateRequest;

class MoviesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Movies::class);

        $search = $request->get('search', '');

        $allMovies = Movies::search($search)
            ->latest()
            ->paginate();

        return new MoviesCollection($allMovies);
    }

    /**
     * @param \App\Http\Requests\MoviesStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MoviesStoreRequest $request)
    {
        $this->authorize('create', Movies::class);

        $validated = $request->validated();

        $movies = Movies::create($validated);

        return new MoviesResource($movies);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movies $movies
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Movies $movies)
    {
        $this->authorize('view', $movies);

        return new MoviesResource($movies);
    }

    /**
     * @param \App\Http\Requests\MoviesUpdateRequest $request
     * @param \App\Models\Movies $movies
     * @return \Illuminate\Http\Response
     */
    public function update(MoviesUpdateRequest $request, Movies $movies)
    {
        $this->authorize('update', $movies);

        $validated = $request->validated();

        $movies->update($validated);

        return new MoviesResource($movies);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movies $movies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Movies $movies)
    {
        $this->authorize('delete', $movies);

        $movies->delete();

        return response()->noContent();
    }
}
