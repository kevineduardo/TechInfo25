@extends('layouts.site')

@if( isset( $nt ) )
  @section('title', $settings['site_name'] . ' - ' . str_limit($nt->title, 50))
@else
  @section('title', $settings['site_name'] . ' - ' . trans('messages.layout.news'))
@endif

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
  @if( isset( $nt ) )

    <div id="noticiasprincipais" class="table-responsive col-md-9">
      <table class="table">
        <thead>
          <tr>
            <th class="vermelho">@lang('messages.layout.noticia')</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>
              <p class="lead">
                {{ $nt->title }}
              </p>
              <div style="width:100%">
                {!! $nt->text !!}
              </div>
            </th>
          </tr>
        </tbody>
      </table>
    </div>

    <div id="listadenoticias" class="table-responsive col-md-3">
      <table class="table">
        <thead>
          <tr>
            <th class="vermelho">@lang('messages.layout.recents')</th>
          </tr>
        </thead>
        <tbody>
          @foreach($nts as $ntz)
          <tr>
            <th>
              <a class="nounder" href="{{ route('notícia', $ntz->id) }}">
                <h4>
                  {{ str_limit($ntz->title, 50) }}
                  <br/><small>{{ str_limit($ntz->subtitle, 50) }}</small>
                </h4>
              </a>
            </th>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  @else

    <div id="listadenoticias" class="table-responsive col-md-8">
      <table class="table">
        <thead>
          <tr>
            <th>@lang('messages.layout.recents')</th>
          </tr>
        </thead>
        <tbody>
          @foreach($nts as $ntz)
          <tr>
            <th style="cursor: pointer;" onclick="window.location='{{ route('notícia', $ntz->id) }}';">
              <h4>
                {{ str_limit($ntz->title, 50) }}
                <br/><small>{{ str_limit($ntz->subtitle, 50) }}</small>
              </h4>
            </th>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td>
              <center>
              {{ $nts->links() }}
              </center>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>

    <div id="facebook" class="table-responsive col-md-4">
        <table class="table">
        <thead>
        <tr>
        <th><span class="vermelho">Facebook</span></th>
        </tr>
        </thead>
        <tbody>
        <tr><th>
          <iframe src="https://www.facebook.com/plugins/page.php?href={{ $settings['facebook_page_url']}}&tabs=timeline&width=300&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=153413051682914" width="300" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        </th></tr>
      </tbody>
        </table>
    </div>

  @endif
@endsection