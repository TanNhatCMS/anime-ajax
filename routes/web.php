<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    Route::any('/ajax/search', [AnimeAjaxController::class, 'ajax_search']);

    Route::post(sprintf('%s/rate', setting('site_routes_movie', '/phim/{movie}')), [
        AnimeAjaxController::class,
        'rateMovie'
    ])
    ->where([
        'movie' => '.+',
        'id' => '[0-9]+'
    ])
    ->name('movie.rating');

    Route::post(sprintf('%s/report', setting('site_routes_episode', '/phim/{movie}/{episode}-{id}')), [
        AnimeAjaxController::class,
            'reportEpisode'
        ])
    ->where(['movie' => '.+', 'episode' => '.+', 'id' => '[0-9]+'])
    ->name('episodes.report');

    Route::get(sprintf('%s/report', setting('site_routes_episode', '/phim/{movie}/{episode}-{id}')), 
    function(Request $request): RedirectResponse
    {   
        return redirect(
            route('episodes.show', [
                'movie' => $request->movie,
                'movie_id' => $request->movie_id,
                'id' => $request->id,
                'episode' => $request->episode 
            ])
        );
    })
    ->where([
                'movie' => '.+',
                'movie_id' => '[0-9]+',
                'episode' => '.+',
                'id' => '[0-9]+'
            ])
    ->name('episodes.report.redirect');

    Route::get(sprintf('%s/rate', setting('site_routes_movie', '/phim/{movie}')),
    function(Request $request): RedirectResponse
    {
        return redirect(route('movies.show', [
            'movie' => $request->movie,
            'id' => $request->id
        ]));
    })
    ->where([
            'movie' => '.+',
            'id' => '[0-9]+'
        ])
    ->name('movie.rating.redirect');
 });