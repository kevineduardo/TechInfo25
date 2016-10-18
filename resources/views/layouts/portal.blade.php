@extends('layouts.app')

@section('styles')
    @parent
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/profile-sidebar.css') }}" />
@endsection

@section('portal')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <div class="profile-userpic">
                    <img src="{{ URL::asset('storage/teste.jpg') }}" class="img-responsive" alt="">
                </div>
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="profile-usertitle-job">
                    @if($professor)
                        Professor
                    @else
                        Aluno
                    @endif
                    </div>
                </div>
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li @if(Route::currentRouteName() == 'portal_inicio') class="active" @endif>
                            <a href="{{ route('portal_inicio') }}">
                            <i class="glyphicon glyphicon-home"></i>
                            Visão Geral </a>
                        </li>
                        <li @if(str_contains(Route::currentRouteName(), 'notas')) class="active" @endif>
                            <a href="{{ route('notas.index') }}">
                            <i class="glyphicon glyphicon-user"></i>
                            Notas </a>
                        </li>
                        <li @if(str_contains(Route::currentRouteName(), 'trabalhos')) class="active" @endif>
                            <a href="{{ route('trabalhos.index') }}">
                            <i class="glyphicon glyphicon-ok"></i>
                            Trabalhos </a>
                        </li>
                        <li @if(str_contains(Route::currentRouteName(), 'notícias')) class="active" @endif>
                            <a href="{{ route('notícias.index') }}">
                            <i class="glyphicon glyphicon-list-alt"></i>
                            Notícias </a>
                        </li>
                        <li @if(str_contains(Route::currentRouteName(), 'fotos')) class="active" @endif>
                            <a href="{{ route('fotos.index') }}">
                            <i class="glyphicon glyphicon-camera"></i>
                            Fotos </a>
                        </li>
                        @if($professor)
                        <li class="@if(str_contains(Route::currentRouteName(), 'usuários')) active @endif teacher-only">
                            <a href="{{ route('usuários.index') }}">
                            <i class="glyphicon glyphicon-th-list"></i>
                            Usuários </a>
                        </li>
                        <li class="@if(str_contains(Route::currentRouteName(), 'configurações')) active @endif teacher-only">
                            <a href="{{ route('configurações.index') }}">
                            <i class="glyphicon glyphicon-cog"></i>
                            Configurações </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('title')</div>

                <div class="panel-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
