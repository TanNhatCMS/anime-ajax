<?php
use Illuminate\Support\Facades\Route;
use Tannhatcms\Theme8anime\Controllers\Theme8animeController;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
    ),
], function () {
    Route::get('/', [Theme8animeController::class, 'index']);
    Route::get('/home', [Theme8animeController::class, 'home'])->name('home');
    Route::get('/search', [Theme8animeController::class, 'search']);
    Route::get('/ajax/search', [Theme8animeController::class, 'ajax_search']);
    Route::post('/ajax/search', [Theme8animeController::class, 'ajax_search']);
    Route::get(sprintf('/%s/{category}', config('ophim.routes.category', 'the-loai')), [Theme8animeController::class, 'getMovieOfCategory'])->name('categories.movies.index');
    Route::get(sprintf('/%s/{actor}', config('ophim.routes.actors', 'dien-vien')), [Theme8animeController::class, 'getMovieOfActor'])->name('actors.movies.index');
    Route::get(sprintf('/%s/{director}', config('ophim.routes.directors', 'dao-dien')), [Theme8animeController::class, 'getMovieOfDirector'])->name('directors.movies.index');
    Route::get(sprintf('/%s/{tag}', config('ophim.routes.tags', 'tu-khoa')), [Theme8animeController::class, 'getMovieOfTag'])->name('tags.movies.index');
    Route::get(sprintf('/%s/{region}', config('ophim.routes.region', 'quoc-gia')), [Theme8animeController::class, 'getMovieOfRegion'])->name('regions.movies.index');
    Route::get(sprintf('/%s/{type}', config('ophim.routes.types', 'danh-sach')), [Theme8animeController::class, 'getMovieOfType'])->name('types.movies.index');
    Route::get(sprintf('/%s/{movie}', config('ophim.routes.movie', 'phim')), [Theme8animeController::class, 'getMovieOverview'])->name('movies.show');
    Route::get(sprintf('/%s/{movie}/{episode}-{id}', config('ophim.routes.movie', 'phim')), [Theme8animeController::class, 'getEpisode'])
        ->where(['movie' => '.+', 'episode' => '.+', 'id' => '[0-9]+'])->name('episodes.show');
    Route::post(sprintf('/%s/{movie}/{episode}-{id}/report', config('ophim.routes.movie', 'phim')), [Theme8animeController::class, 'reportEpisode'])
        ->where(['movie' => '.+', 'episode' => '.+', 'id' => '[0-9]+'])->name('episodes.report');
    Route::post(sprintf('/%s/{movie}/rate', config('ophim.routes.movie', 'phim')), [Theme8animeController::class, 'rateMovie'])->name('movie.rating');
    Route::post(sprintf('/%s/{movie}/{episode}-{id}/report', config('ophim.routes.movie', 'phim')), [Theme8animeController::class, 'reportEpisode'])
    ->where(['movie' => '.+', 'episode' => '.+', 'id' => '[0-9]+'])->name('episodes.report');

    Route::get(sprintf('/%s/{movie}/{episode}-{id}/report', config('ophim.routes.movie', 'phim')), 
    function( $movie, $slug, $id)
    {
        return redirect('/phim/'.$movie.'/'.$slug.'-'.$id);
    }
    )
    ->where(['movie' => '.+', 'episode' => '.+', 'id' => '[0-9]+'])->name('episodes.report.redirect');
    Route::get(sprintf('/%s/{movie}/rate', config('ophim.routes.movie', 'phim')),
    function($movie)
    {
    return redirect('/phim/'.$movie);
    })->name('movie.rating.redirect');
 });