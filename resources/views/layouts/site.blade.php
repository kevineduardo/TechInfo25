<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    @section('styles')
    <link rel="icon" type="image/png" href="{{ URL::asset('favicon.ico') }}" />
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('favicon.ico') }}"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('favicon.ico') }}"/>

    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/ti25.css') }}" />
    @show

    <!-- Scripts -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @section('javascript')
    <script src="{{ URL::asset('js/jquery.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    @show

</head>
<body>
    @include('navbars.site')
    <div id="header" class="row container-fluid">
    <a href="{{ route('inicio') }}"><img id="logo" class="col-md-3" src="{{ URL::asset('img/logo.png') }}"/></a>
    </div>
    <div id="conteudo" class="row container-fluid">
    @yield('content')
    </div>
    <div id="footer" class="text-center">
    <h5>{!! $settings['footer'] !!} <br/> Copyright (C) 2016  Kevin Souza & Lucas Tossi - GNU License</h5>
    </div>
</body>
</html>