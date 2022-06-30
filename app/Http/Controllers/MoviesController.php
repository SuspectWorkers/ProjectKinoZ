<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use App\Models\Genres;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.all_movies.index', compact('allMovies', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Movies::class);

        $allGenres = Genres::pluck('name', 'id');

        return view('app.all_movies.create', compact('allGenres'));
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

        return redirect()
            ->route('all-movies.edit', $movies)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movies $movies
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Movies $movies)
    {
        $this->authorize('view', $movies);

        return view('app.all_movies.show', compact('movies'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movies $movies
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Movies $movies)
    {
        $this->authorize('update', $movies);

        $allGenres = Genres::pluck('name', 'id');

        return view('app.all_movies.edit', compact('movies', 'allGenres'));
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

        return redirect()
            ->route('all-movies.edit', $movies)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('all-movies.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
