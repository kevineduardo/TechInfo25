@extends('layouts.site')

@section('title', $settings['site_name'] . ' - ' . trans("messages.layout.subjects"))

@section('styles')
  @parent
  <style>
    .ml {
      padding: 5px;
      padding-top: 10px;
      width: 100%;
    }
  </style>
@endsection

@section('content')
<div id="principal" class="table-responsive col-md-8">
    <table class="table">
      <thead>
      <tr>
      <th><span class="vermelho">{{ trans("messages.layout.subjects") }}</span></th>
      </tr>
      </thead>
      <tbody class="normal">
      <tr><th>
      <div class="nttexto" style="width: 100%;">
        @if( count($materias) > 0 )
        <ul class="ml list-group">
          @each("partials.materia",$materias,"materia")
        </ul>
        @endif
        <center>
          {{ $materias->links() }}
        </center>
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
@endsection