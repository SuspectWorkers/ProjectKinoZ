<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikedMoviesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('users', UserController::class);
        Route::get('all-movies', [MoviesController::class, 'index'])->name(
            'all-movies.index'
        );
        Route::post('all-movies', [MoviesController::class, 'store'])->name(
            'all-movies.store'
        );
        Route::get('all-movies/create', [
            MoviesController::class,
            'create',
        ])->name('all-movies.create');
        Route::get('all-movies/{movies}', [
            MoviesController::class,
            'show',
        ])->name('all-movies.show');
        Route::get('all-movies/{movies}/edit', [
            MoviesController::class,
            'edit',
        ])->name('all-movies.edit');
        Route::put('all-movies/{movies}', [
            MoviesController::class,
            'update',
        ])->name('all-movies.update');
        Route::delete('all-movies/{movies}', [
            MoviesController::class,
            'destroy',
        ])->name('all-movies.destroy');

        Route::get('all-liked-movies', [
            LikedMoviesController::class,
            'index',
        ])->name('all-liked-movies.index');
        Route::post('all-liked-movies', [
            LikedMoviesController::class,
            'store',
        ])->name('all-liked-movies.store');
        Route::get('all-liked-movies/create', [
            LikedMoviesController::class,
            'create',
        ])->name('all-liked-movies.create');
        Route::get('all-liked-movies/{likedMovies}', [
            LikedMoviesController::class,
            'show',
        ])->name('all-liked-movies.show');
        Route::get('all-liked-movies/{likedMovies}/edit', [
            LikedMoviesController::class,
            'edit',
        ])->name('all-liked-movies.edit');
        Route::put('all-liked-movies/{likedMovies}', [
            LikedMoviesController::class,
            'update',
        ])->name('all-liked-movies.update');
        Route::delete('all-liked-movies/{likedMovies}', [
            LikedMoviesController::class,
            'destroy',
        ])->name('all-liked-movies.destroy');

        Route::get('all-genres', [GenresController::class, 'index'])->name(
            'all-genres.index'
        );
        Route::post('all-genres', [GenresController::class, 'store'])->name(
            'all-genres.store'
        );
        Route::get('all-genres/create', [
            GenresController::class,
            'create',
        ])->name('all-genres.create');
        Route::get('all-genres/{genres}', [
            GenresController::class,
            'show',
        ])->name('all-genres.show');
        Route::get('all-genres/{genres}/edit', [
            GenresController::class,
            'edit',
        ])->name('all-genres.edit');
        Route::put('all-genres/{genres}', [
            GenresController::class,
            'update',
        ])->name('all-genres.update');
        Route::delete('all-genres/{genres}', [
            GenresController::class,
            'destroy',
        ])->name('all-genres.destroy');

        Route::resource('comments', CommentController::class);
    });
	
Route::get('/dummy/{filename}', function($filename){
    $path = resource_path() . '/dummy/' . $filename;

    if(!File::exists($path)) {
        return $path;
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('/css/{filename}', function($filename){
    $path = resource_path() . '/css/' . $filename;

    if(!File::exists($path)) {
        return $path;
    }

    $file = File::get($path);
    $type = 'text/css; charset=utf-8';

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

