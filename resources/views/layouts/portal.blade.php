@extends('layouts.app')

@section('styles')
    @parent
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/profile-sidebar.css') }}" />
@endsection

@section('portal')
<div class="container">
    <div class="row">
        <div class="row">
        <div id="menusidebar" class="col-md-3">
            <div class="profile-sidebar" style="margin-bottom: 10px;">
                <div class="profile-userpic">
                    @if(Auth::user()->avatar())
                    <img src="{{ Auth::user()->avatar()->ext_path }}" class="img-responsive" alt="">
                    @else
                    <img src="{{ URL::asset('storage/teste.jpg') }}" class="img-responsive" alt="">
                    @endif
                </div>
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="profile-usertitle-job">
                    @if($professor)
                        @lang('messages.teacher')
                    @else
                        @lang('messages.student')
                    @endif
                    </div>
                </div>
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li @if(Route::currentRouteName() == 'portal_inicio') class="active" @endif>
                            <a href="{{ route('portal_inicio') }}">
                            <i class="glyphicon glyphicon-home"></i>
                            @lang('messages.menu.overview') </a>
                        </li>
                        <li @if(str_contains(Route::currentRouteName(), 'notas')) class="active" @endif>
                            <a href="{{ route('notas.index') }}">
                            <i class="glyphicon glyphicon-user"></i>
                            @lang('messages.menu.grades') </a>
                        </li>
                        <li @if(str_contains(Route::currentRouteName(), 'trabalhos')) class="active" @endif>
                            <a href="{{ route('trabalhos.index') }}">
                            <i class="glyphicon glyphicon-ok"></i>
                            @lang('messages.menu.homeworks') </a>
                        </li>
                        <li @if(str_contains(Route::currentRouteName(), 'notícias') || str_contains(Route::currentRouteName(), 'notícias-alunos')) class="active" @endif>
                            <a href="{{ route('notícias.index') }}">
                            <i class="glyphicon glyphicon-list-alt"></i>
                            @lang('messages.menu.news') </a>
                        </li>
                        @if(Auth::user()->teacher)
                        <li class="@if(str_contains(Route::currentRouteName(), 'fotos')) active @endif teacher-only">
                            <a href="{{ route('fotos.index') }}">
                            <i class="glyphicon glyphicon-camera"></i>
                            @lang('messages.menu.pictures') </a>
                        </li>
                        <li class="@if(str_contains(Route::currentRouteName(), 'professor')) active @endif teacher-only">
                            <a href="{{ route('professor.index') }}">
                            <i class="glyphicon glyphicon-cog"></i>
                            @lang('messages.menu.teacherdashboard') </a>
                        </li>
                        @if(Auth::user()->teacher->type > 1)
                            <li class="@if(str_contains(Route::currentRouteName(), 'usuários')) active @endif teacher-only">
                                <a href="{{ route('usuários.index') }}">
                                <i class="glyphicon glyphicon-th-list"></i>
                                @lang('messages.menu.users') </a>
                            </li>
                        <li class="@if(str_contains(Route::currentRouteName(), 'configurações')) active @endif teacher-only">
                            <a href="{{ route('configurações.index') }}">
                            <i class="glyphicon glyphicon-cog"></i>
                            @lang('messages.menu.config') </a>
                        </li>
                        @else
                        <li class="@if(str_contains(Route::currentRouteName(), 'usuários')) active @endif teacher-only">
                            <a href="{{ route('usuários-alunos.index') }}">
                            <i class="glyphicon glyphicon-th-list"></i>
                            @lang('messages.menu.usersinvite') </a>
                        </li>
                        @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div id="conteudogeral" class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('title')</div>

                <div class="panel-body">
                    @yield('content')
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
