<?php
// Copyright (C) 2016  Kevin Souza
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('navbars.site', 'App\Http\ViewComposers\NavbarComposer');
        View::composer(['inicio', 'pagina', 'foto', 'noticia', 'portal.*', 'layouts.app'], 'App\Http\ViewComposers\SettingComposer');
        View::composer(['portal.*'], 'App\Http\ViewComposers\TeacherComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
