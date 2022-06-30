<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Movies;
use App\Models\LikedMovies;
use Illuminate\Http\Request;
use App\Http\Requests\LikedMoviesStoreRequest;
use App\Http\Requests\LikedMoviesUpdateRequest;

class LikedMoviesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', LikedMovies::class);

        $search = $request->get('search', '');

        $allLikedMovies = LikedMovies::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_liked_movies.index',
            compact('allLikedMovies', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', LikedMovies::class);

        $allMovies = Movies::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.all_liked_movies.create',
            compact('allMovies', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\LikedMoviesStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LikedMoviesStoreRequest $request)
    {
        $this->authorize('create', LikedMovies::class);

        $validated = $request->validated();

        $likedMovies = LikedMovies::create($validated);

        return redirect()
            ->route('all-liked-movies.edit', $likedMovies)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LikedMovies $likedMovies
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, LikedMovies $likedMovies)
    {
        $this->authorize('view', $likedMovies);

        return view('app.all_liked_movies.show', compact('likedMovies'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LikedMovies $likedMovies
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, LikedMovies $likedMovies)
    {
        $this->authorize('update', $likedMovies);

        $allMovies = Movies::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.all_liked_movies.edit',
            compact('likedMovies', 'allMovies', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\LikedMoviesUpdateRequest $request
     * @param \App\Models\LikedMovies $likedMovies
     * @return \Illuminate\Http\Response
     */
    public function update(
        LikedMoviesUpdateRequest $request,
        LikedMovies $likedMovies
    ) {
        $this->authorize('update', $likedMovies);

        $validated = $request->validated();

        $likedMovies->update($validated);

        return redirect()
            ->route('all-liked-movies.edit', $likedMovies)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LikedMovies $likedMovies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, LikedMovies $likedMovies)
    {
        $this->authorize('delete', $likedMovies);

        $likedMovies->delete();

        return redirect()
            ->route('all-liked-movies.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
