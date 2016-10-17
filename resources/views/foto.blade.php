@extends('layouts.site')


@section('title', $settings['site_name'] . ' - ' . $title)

@section('styles')
  @parent
    <link rel="stylesheet" href="{{ URL::asset('fancybox/source/jquery.fancybox.css?v=2.1.5') }}" type="text/css" media="screen" />
@endsection

@section('javascript')
  @parent
    <script type="text/javascript" src="{{ URL::asset('js/mousewheel.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/easing.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('widget/lib/jquery.ui.core.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('widget/lib/jquery.ui.widget.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('widget/lib/jquery.ui.rcarousel.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('fancybox/source/jquery.fancybox.pack.js') }}?v=2.1.5"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox();
      });
    </script>
@endsection

@section('content')
    <div id="principal" class="table-responsive col-md-8">
    <table class="table">
      <thead>
      <tr>
      <th>{{ $title }}</th>
      </tr>
      </thead>
      <tbody class="normal">
      <tr><th>
            <div class="boxfoto">
            <a class="fancybox" rel="group" href="{{ URL::asset($path) }}">
            <img class="imggl2" src="{{ URL::asset($path) }}" />
            </a>
            </div>
      </th></tr>
      </tbody>
      </table>
  </div>{{-- Tem que criar uma condição aqui, caso não tenha página no facebook --}}
  <div id="facebook" class="table-responsive col-md-4">
      <table class="table">
      <thead>
      <tr>
      <th>Facebook</th>
      </tr>
      </thead>
      <tbody>
      <tr><th>
        <iframe src="https://www.facebook.com/plugins/page.php?href={{ $settings['facebook_page_url']}}&tabs=timeline&width=300&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=153413051682914" width="300" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
      </th></tr>
    </tbody>
      </table>
  </div>
@endsection