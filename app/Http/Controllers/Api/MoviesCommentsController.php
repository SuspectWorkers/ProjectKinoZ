<?php

namespace App\Http\Controllers\Api;

use App\Models\Movies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentCollection;

class MoviesCommentsController extends Controller
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

        $comments = $movies
            ->comments()
            ->search($search)
            ->latest()
            ->paginate();

        return new CommentCollection($comments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movies $movies
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Movies $movies)
    {
        $this->authorize('create', Comment::class);

        $validated = $request->validate([
            'text' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $comment = $movies->comments()->create($validated);

        return new CommentResource($comment);
    }
}
