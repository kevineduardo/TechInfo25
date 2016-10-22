@extends('layouts.site')

@section('title', $settings['site_name'] . ' - ' . trans("messages.layout.docente"))

@section('javascript')
  <script src="{{ URL::asset('js/jquery.js') }}"></script>
  <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ URL::asset('tinymce/tinymce.min.js') }}"></script>
  <script>
    function echo(s){console.log(s);}
    function getInfo(id) {
      echo('docentes/' + id);
      $.ajax({
        method:'GET',
        url: '/docentes/' + id,
        dataType: 'json',
        success: function(data) {
            console.log(data);
          if ( data.ok ) {
            var p = data.docente;
            $("#Dtipo").html(p.tipo);
            $("#Dbio").html(p.bio);
            $("#Dnome").html(p.name);
            $("#Dformacao").html(p.academic_bg);
            $("#showinfo").modal('show');
          }
        }
      });
    }
  </script>
@endsection

@section('content')
<div id="principal" class="table-responsive col-md-8">
    <table class="table">
      <thead>
      <tr>
      <th><span class="vermelho">@lang('messages.layout.docente')</span></th>
      </tr>
      </thead>
      <tbody class="normal">
      <tr><th>
      <div style="width:100%;">
        <ul class="list-group">
        @foreach( $docentes as $teacher )
          <li class="list-group-item" style="margin-top: 20px; height:auto; overflow:hidden;
          -webkit-box-shadow: 0px 0px 28px -5px rgba(0,0,0,1);
          -moz-box-shadow: 0px 0px 28px -5px rgba(0,0,0,1);
          box-shadow: 0px 0px 28px -5px rgba(0,0,0,1);">
              <div style="background: url('http://placehold.it/200x200'); background-position: center; background-repeat: no-repeat; height: 200px; width: 200px; float:left;">
              </div>
              <div style="width: calc(100% - 220px); height: 200px; overflow: hidden; display: inline-block; float:right;">
                <div height="50px" style="padding-top: 5px;"><span style="font-size: 20px;" class="vermelho">{{ $teacher->user->name }}</span> </div>
                <div style="height: 125px; display: table; width: 100%">
                  <p class="nttexto" style="color:#333; display: table-cell; vertical-align: middle;">
                    {{ ( strlen( $teacher->bio ) > ( 150 ) ) ? ( substr( $teacher->bio, 0, 150 ) . '...' ) : ( $teacher->bio ) }}
                  </p>
                </div>
                <div height="50px">
                  <span style="float:right; color: #333;">
                    <button class="btn btn-default" onclick="getInfo({{ $teacher->user_id }});">Ver mais</button>
                  </span>
                </div>
              </div>
          </li>
        @endforeach
        </ul>
        <div style="text-align: center;" width="100%">
          {{ $docentes->links() }}
        </div>
      </div>
      </th></tr>
      </tbody>
      </table>
  </div>
{{-- Nah, faz um validator na hora de editar a facebook_page_url, n pode ter menos q 5 chars --}}
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

  <div class="modal fade" id="showinfo" role="dialog">
    <div class="modal-dialog modal-sm" style="width: 50%">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.docentes')<span id="Dtipo">professor(a)</span></h4>
        </div>
        <div class="modal-body" style="overflow: hidden;">
          <div class="col-md" style="display: inline-block; float: left;">
            <img id="Dimg" src="http://placehold.it/200x200" width="200px" height="200px"/>
          </div>
          <div class="col-md" style="display: inline-block; float: right; width: calc( 100% - 210px ); padding-right: 5px;">
            <h4 class="vermelho">Nome: 
              <span style="color:#333" id="Dnome"></span>
            </h4>
            <h5 class="vermelho">Formação: <span style="color:#333" id="Dformacao"></span></h5>
            <p id="Dbio" class="nttexto"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection