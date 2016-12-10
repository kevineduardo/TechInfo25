@extends('layouts.site')

@section('title', $settings['site_name'] . ' - ' . trans( 'messages.layout.map' ))

@section('javascript')
  @parent
  <script>
    var LatLng = {lat: -28.3790677, lng: -53.9250415 };
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: LatLng,
        zoom: 18
      });

      var marker = new google.maps.Marker({
        position: LatLng,
        map: map,
        title: '{{ trans('messages.layout.name') }}'
      });

      $('#map').css({
        height: '500px', 
        width: '100%',
      });
    }
  </script>
  <script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ $key }}&callback=initMap"></script>
@endsection

@section('content')
<div id="principal" class="table-responsive col-md-8">
    <table class="table">
      <thead>
      <tr>
      <th><span class="vermelho">@lang('messages.layout.map')</span></th>
      </tr>
      </thead>
      <tbody class="normal">
      <tr><th>
      <div class="nttexto col-md-12" style="height: 500px; width: 100%;">
        <div id="map"></div>
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