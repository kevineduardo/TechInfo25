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
        View::composer(['inicio', 'materias', 'mapa', 'contato', 'pagina', 'foto', 'noticia', 'portal.*', 'docentes', 'calendario', 'layouts.app'], 'App\Http\ViewComposers\SettingComposer');
        View::composer(['portal.*'], 'App\Http\ViewComposers\TeacherComposer');
        View::composer(['portal.usuarios', 'portal.usuarios_alunos'], 'App\Http\ViewComposers\ClassesComposer');
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
