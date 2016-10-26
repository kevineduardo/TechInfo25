@extends('layouts.site')

@section('title', $settings['site_name'] . ' - ' . trans("messages.layout.calendar"))

@section('javascript')
  <link rel='stylesheet' href='{{ URL::asset('css/fullcalendar.css') }}' />
  <script src="{{ URL::asset('js/jquery.js') }}"></script>
  <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ URL::asset('js/moment.js') }}"></script>
  <script src='{{ URL::asset('js/fullcalendar.js') }}'></script>
@endsection

@section('content')
<div id="principal" class="table-responsive col-md-8">
    <table class="table">
      <thead>
      <tr>
      <th><span class="vermelho">{{trans("messages.layout.calendar")}}</span></th>
      </tr>
      </thead>
      <tbody class="normal">
      <tr><th>
      <div id="calendario"></div>
      <script>
        $(function(){
          $('#calendario').fullCalendar({
            events : 'calendário/get',
          }); 
          /*
          $('#calendario').fullCalendar({
            events : function(start, end, callback) {
              console.log('ran');
              $.ajax({
                method:'GET',
                dataType: 'json',
                url : '/calendário/get?start=' + start + '&end=' + end,
                success: function(data) {
                  console.log('/calendário/get?start=' + start + '&end=' + end);
                  console.log(data);
                }
              });
            },
          })
          */

        })
      </script>
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