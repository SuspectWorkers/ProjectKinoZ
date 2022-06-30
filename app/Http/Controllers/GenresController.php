<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.all_genres.index', compact('allGenres', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Genres::class);

        return view('app.all_genres.create');
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

        return redirect()
            ->route('all-genres.edit', $genres)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Genres $genres
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Genres $genres)
    {
        $this->authorize('view', $genres);

        return view('app.all_genres.show', compact('genres'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Genres $genres
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Genres $genres)
    {
        $this->authorize('update', $genres);

        return view('app.all_genres.edit', compact('genres'));
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

        return redirect()
            ->route('all-genres.edit', $genres)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('all-genres.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
