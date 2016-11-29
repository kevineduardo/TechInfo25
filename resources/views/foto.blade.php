@extends('layouts.site')


@section('title', $settings['site_name'] . ' - ' . trans('messages.layout.img'))

@section('styles')
  @parent
    <link rel="stylesheet" href="{{ URL::asset('fancybox/source/jquery.fancybox.css?v=2.1.5') }}" type="text/css" media="screen" />
    <style>
      .img {
        width: 100px; 
        height: 100px; 
        margin: 2px; 
        margin-bottom: 5px;
        overflow: hidden; 
        border-radius: 2px;
        border: solid 3px #3366cc;
        cursor: pointer;
      }
    </style>
@endsection

@section('javascript')
  @parent
    <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.img').click(function(){
          var img = $(this);
          var id = $(this).attr('img');
          $.ajax({
            method:'POST',
            url: '/fotos/',
            dataType: 'json',
            headers: 
            { 
              'X-CSRF-TOKEN': Laravel.csrfToken,
            },
            data:{
              id: id
            },
            success: function(data){
              $('#img-modal').attr('src', img.attr('src'));
              $('#img-href').attr('href', '/fotos/' + id);
              $('#img-title').text(data['title']);
              $('#img-desc').text(data['description']);
              $('#picmodal').modal();
            }
          });
        });
    });
    </script>
@endsection

@section('content')
    <div id="principal" class="table-responsive col-md-8">
    <table class="table">
      <thead>
      <tr>
      <th><span class="vermelho">@lang('messages.layout.img')</span></th>
      </tr>
      </thead>
      <tbody class="normal">
      <tr><th>
        @if(isset($path))
          @if(empty($ext_path))
            <a rel="group" href="{{ URL::asset($path) }}">
            <img class="imggl2" style="width:100%; margin-top: 10px; height: auto; border-radius: 5px;" src="{{ URL::asset($path) }}" />
          @else
            <a rel="group" href="{{ $ext_path }}">
            <img class="imggl2" style="width:100%; margin-top: 10px; height: auto; border-radius: 5px;" src="{{ $ext_path }}" />
          @endif
          </a>
          <hr>
          <h4 class="vermelho" id="img-title">{{ $title }}</h4>
          <p id="img-desc">{{ $description }}</p>
        @else
          <div>
            @foreach($pics as $pic)
              @if(empty($pic->ext_path))
                <img class="imggl2 img" img="{{ $pic->id }}" src="{{ URL::asset($pic->path) }}"/>
              @else
                <img class="imggl2 img" img="{{ $pic->id }}" src="{{ $pic->ext_path }}"/>
              @endif
            @endforeach
          </div>
          <div>
            <center>
              {{ $pics->links() }}
            </center>
          </div>
        @endif
      </th></tr>
      </tbody>
      </table>
  </div>{{-- Tem que criar uma condição aqui, caso não tenha página no facebook --}}
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

  
  <div class="modal fade" id="picmodal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body" style="overflow: hidden;">
          <center>
            <a id="img-href">
              <img id="img-modal" style="width: 100%; border-radius: 5px;" src=""/>
            </a>
          </center>
          <hr>
          {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
          <h4 class="vermelho" id="img-title"></h4>
          <p id="img-desc"></p>
          <button style="float: right;" class="btn btn-default" onclick="window.location = $('#img-href').attr('href');">Abrir imagem</button>
        </div>
      </div>
    </div>
  </div>
@endsection