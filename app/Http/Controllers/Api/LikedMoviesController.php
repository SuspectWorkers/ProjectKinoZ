<?php

namespace App\Http\Controllers\Api;

use App\Models\LikedMovies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LikedMoviesResource;
use App\Http\Resources\LikedMoviesCollection;
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
            ->paginate();

        return new LikedMoviesCollection($allLikedMovies);
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

        return new LikedMoviesResource($likedMovies);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LikedMovies $likedMovies
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, LikedMovies $likedMovies)
    {
        $this->authorize('view', $likedMovies);

        return new LikedMoviesResource($likedMovies);
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

        return new LikedMoviesResource($likedMovies);
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

        return response()->noContent();
    }
}
