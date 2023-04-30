<?php

namespace Tannhatcms\AnimeAjax;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AnimeAjaxServiceProvider extends ServiceProvider
{
    public function register()
    {
    }
    public function boot()
    {
        //$this->loadViewsFrom(__DIR__ . '/../resources/views/ajax', 'ajax');
    }

}