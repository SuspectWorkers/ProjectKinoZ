<?php

namespace App\Http\Controllers\Api;

use App\Models\Genres;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GenresResource;
use App\Http\Resources\GenresCollection;
use App\Http\Requests\GenresStoreRequest;
use App\Http\Requests\GenresUpdateRequest;

class GenresController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Genres::class);

        $search = $request->get('search', '');

        $allGenres = Genres::search($search)
            ->latest()
            ->paginate();

        return new GenresCollection($allGenres);
    }

    /**
     * @param \App\Http\Requests\GenresStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenresStoreRequest $request)
    {
        $this->authorize('create', Genres::class);

        $validated = $request->validated();

        $genres = Genres::create($validated);

        return new GenresResource($genres);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Genres $genres
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Genres $genres)
    {
        $this->authorize('view', $genres);

        return new GenresResource($genres);
    }

    /**
     * @param \App\Http\Requests\GenresUpdateRequest $request
     * @param \App\Models\Genres $genres
     * @return \Illuminate\Http\Response
     */
    public function update(GenresUpdateRequest $request, Genres $genres)
    {
        $this->authorize('update', $genres);

        $validated = $request->validated();

        $genres->update($validated);

        return new GenresResource($genres);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Genres $genres
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Genres $genres)
    {
        $this->authorize('delete', $genres);

        $genres->delete();

        return response()->noContent();
    }
}
