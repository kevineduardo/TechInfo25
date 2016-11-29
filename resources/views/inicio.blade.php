@extends('layouts.site')

@section('title', $settings['site_name'])

@section('styles')
  @parent
  <link type="text/css" rel="stylesheet" href="{{ URL::asset('widget/css/rcarousel.css') }}" />
  <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/rhinoslider-1.05.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('fancybox/source/jquery.fancybox.css?v=2.1.5') }}" type="text/css" media="screen" />
  <style>
    .calendario {
      cursor: pointer;
    }
  </style>
@endsection

@section('javascript')
  @parent
  <script type="text/javascript" src="{{ URL::asset('js/rhinoslider-1.05.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/mousewheel.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/easing.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('widget/lib/jquery.ui.core.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('widget/lib/jquery.ui.widget.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('widget/lib/jquery.ui.rcarousel.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('fancybox/source/jquery.fancybox.pack.js') }}?v=2.1.5"></script>
    <script type="text/javascript">
      jQuery(function($) {
        $( "#carousel ").rcarousel({
          margin: 10
        });

        $( "#ui-carousel-next" )
          .add( "#ui-carousel-prev" )
          .hover(
            function() {
              $( this ).css( "opacity", 0.7 );
            },
            function() {
              $( this ).css( "opacity", 1.0 );
            }
          );
      });

      $(document).ready(function(){
        $('#slider').rhinoslider({
          randomOrder: false,
          controlsPlayPause: false,
          autoPlay: true,
          showCaptions: 'always',
          showBullets: 'always',
          effect: 'slide'
        });
      });

    $(document).ready(function() {
        $(".fancybox").fancybox();
      });
    </script>
@endsection

@section('content')
<div id="noticiasprincipais" class="table-responsive col-md-8">
    <table class="table">
      <thead>
      <tr>
      <th><span class="vermelho">@lang('messages.layout.noticiasp')</span></th>
      </tr>
      </thead>
      <tbody>
      <tr><th>
      <ul id="slider">
        @each('partials.slider', $noticias, 'n')
      </ul>
      </th></tr>
      </tbody>
      </table>
  </div>

  <div id="agenda" class="table-responsive col-md-4">
      <table class="table">
      <thead>
      <tr>
      <th><span class="vermelho">@lang('messages.layout.agenda')</span></th>
      </tr>
      </thead>
      <tbody>
      @if(count($calendario) == 0)
      <tr><th><p class="text-center">@lang('messages.layout.sagenda')</p></th></tr>
      @else
      @each('partials.calendar', $calendario, 'calendario')
      @endif
    </tbody>
      </table>
  </div>

  <div class="semscroll table-responsive col-md-12">
    <table class="table">
    <thead>
    <tr>
    <th><span class="vermelho">@lang('messages.layout.galeria')</span></th>
    </tr>
    </thead>
    <tbody>
    <tr><th>
      <div id="galeria">
      <div id="carousel">
      @if(isset($fotos))
        @each('partials.fancybox_picture', $fotos, 'fotos')
      @endif
      </div>
      <a href="#" id="ui-carousel-next"><span>next</span></a>
      <a href="#" id="ui-carousel-prev"><span>prev</span></a>
    </div>
    </th></tr>
  </tbody>
    </table>
</div>
@endsection