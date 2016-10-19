@extends('layouts.site')


@section('title', $settings['site_name'] . ' - ' . str_limit($nt->title, 50))

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
    <div id="listadenoticias" class="table-responsive col-md-3">
<table class="table">
  			<thead>
  			<tr>
  			<th>@lang('messages.layout.recents')</th>
  			</tr>
  			</thead>
  			<tbody>
			@foreach($nts as $ntz)
			<tr><th><a class="nounder" href="{{ route('notícia', $ntz->id) }}"><h4>
			{{ str_limit($ntz->title, 50) }}
			<br/><small>{{ str_limit($ntz->subtitle, 50) }}</small></h4></a></th></tr>
			@endforeach
  			</tbody>
  			</table>
		</div>
		<div id="noticiasprincipais" class="table-responsive col-md-9">
			<table class="table">
  			<thead>
  			<tr>
  			<th>@lang('messages.layout.noticia')</th>
  			</tr>
  			</thead>
  			<tbody>
			<tr><th><p class="lead">
			{{ $nt->title }}
			</p>
			<div class="nttexto">
			{!! $nt->text !!}
			</div>
  			</th></tr>
  			</tbody>
  			</table>
		</div>
@endsection