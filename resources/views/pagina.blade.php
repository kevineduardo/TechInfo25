@extends('layouts.site')

@section('title', $settings['site_name'] . ' - ' . $title)

@section('content')
<div id="principal" class="table-responsive col-md-8">
    <table class="table">
      <thead>
      <tr>
      <th><span class="vermelho">{{ $title }}</span></th>
      </tr>
      </thead>
      <tbody class="normal">
      <tr><th>
      <div class="nttexto">
      {{ $text }}
      </div>
      </th></tr>
      </tbody>
      </table>
  </div>
{{-- Tem que criar uma condição aqui, caso não tenha página no facebook --}}
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