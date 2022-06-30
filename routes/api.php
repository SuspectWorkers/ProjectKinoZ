<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MoviesController;
use App\Http\Controllers\Api\GenresController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikedMoviesController;
use App\Http\Controllers\Api\UserCommentsController;
use App\Http\Controllers\Api\MoviesCommentsController;
use App\Http\Controllers\Api\GenresAllMoviesController;
use App\Http\Controllers\Api\UserAllLikedMoviesController;
use App\Http\Controllers\Api\MoviesAllLikedMoviesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('users', UserController::class);

        // User All Liked Movies
        Route::get('/users/{user}/all-liked-movies', [
            UserAllLikedMoviesController::class,
            'index',
        ])->name('users.all-liked-movies.index');
        Route::post('/users/{user}/all-liked-movies', [
            UserAllLikedMoviesController::class,
            'store',
        ])->name('users.all-liked-movies.store');

        // User Comments
        Route::get('/users/{user}/comments', [
            UserCommentsController::class,
            'index',
        ])->name('users.comments.index');
        Route::post('/users/{user}/comments', [
            UserCommentsController::class,
            'store',
        ])->name('users.comments.store');

        Route::apiResource('all-movies', MoviesController::class);

        // Movies Comments
        Route::get('/all-movies/{movies}/comments', [
            MoviesCommentsController::class,
            'index',
        ])->name('all-movies.comments.index');
        Route::post('/all-movies/{movies}/comments', [
            MoviesCommentsController::class,
            'store',
        ])->name('all-movies.comments.store');

        // Movies All Liked Movies
        Route::get('/all-movies/{movies}/all-liked-movies', [
            MoviesAllLikedMoviesController::class,
            'index',
        ])->name('all-movies.all-liked-movies.index');
        Route::post('/all-movies/{movies}/all-liked-movies', [
            MoviesAllLikedMoviesController::class,
            'store',
        ])->name('all-movies.all-liked-movies.store');

        Route::apiResource('all-liked-movies', LikedMoviesController::class);

        Route::apiResource('all-genres', GenresController::class);

        // Genres All Movies
        Route::get('/all-genres/{genres}/all-movies', [
            GenresAllMoviesController::class,
            'index',
        ])->name('all-genres.all-movies.index');
        Route::post('/all-genres/{genres}/all-movies', [
            GenresAllMoviesController::class,
            'store',
        ])->name('all-genres.all-movies.store');

        Route::apiResource('comments', CommentController::class);
    });
