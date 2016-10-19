<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{ App::getLocale() }}" lang="{{ App::getLocale() }}">
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
    <a href="{{ route('inicio') }}"><img id="logo" class="col-md-3" alt="logo" src="{{ URL::asset('img/logo.png') }}"/></a>
    </div>
    <section>
    <div id="conteudo" class="row container-fluid">
    @yield('content')
    </div>
    </section>
    <footer id="footer" class="text-center">
    <h5>{!! $settings['footer'] !!} <br/> Copyright (C) 2016  Kevin Souza & Lucas Tossi - <a href="https://www.gnu.org/licenses/gpl-3.0.html">GPL 3.0</a></h5>
<p>
    <a href="http://validator.w3.org/check?uri=referer">
    <img style="border:0;width:88px;height:31px"
        src="https://www.w3.org/Icons/wai194-v.svg"
        alt="@lang('messages.alt.acb')" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
    <img style="border:0;width:88px;height:31px"
        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
        alt="@lang('messages.alt.css')" />
    </a>
    <a href="http://validator.w3.org/check?uri=referer">
    <img style="border:0;width:88px;height:31px"
        src="https://www.w3.org/Icons/valid-mathml20-blue-v.svg"
        alt="@lang('messages.alt.mathml')" />
    </a>
    <a href="http://validator.w3.org/check?uri=referer">
    <img style="border:0;width:88px;height:31px"
        src="https://www.w3.org/Icons/valid-svg11-blue-v.svg"
        alt="@lang('messages.alt.svg')" />
    </a>
    <a href="http://validator.w3.org/check?uri=referer">
    <img style="border:0;width:88px;height:31px"
        src="https://www.w3.org/Icons/valid-html401-blue-v.svg"
        alt="@lang('messages.alt.html')" />
    </a>
    <a href="http://validator.w3.org/check?uri=referer">
    <img style="border:0;width:88px;height:31px"
        src="https://www.w3.org/html/logo/badge/html5-badge-h-css3-semantics.png"
        alt="HTML5 Powered with CSS3 / Styling, and Semantics" />
    </a>
</p>
    </footer>
</body>
</html>