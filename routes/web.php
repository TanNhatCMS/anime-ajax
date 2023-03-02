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
    Route::get('/ajax/search', [Theme8animeController::class, 'ajax_search']);
    Route::post('/ajax/search', [Theme8animeController::class, 'ajax_search']);
 });