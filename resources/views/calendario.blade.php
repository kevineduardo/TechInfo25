@extends('layouts.site')

@section('title', $settings['site_name'] . ' - ' . trans("messages.layout.calendar"))

@section('javascript')
  <link rel='stylesheet' href='{{ URL::asset('css/fullcalendar.css') }}' />
  <script src="{{ URL::asset('js/jquery.js') }}"></script>
  <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ URL::asset('js/moment.js') }}"></script>
  <script src='{{ URL::asset('js/fullcalendar.js') }}'></script>
  <script src='{{ URL::asset('js/fullcalendar-pt-br.js') }}'></script>
  <script type="text/javascript">
    function getData( url ) 
    {
      $.ajax({
        url : url,
        headers: 
        { 
          'X-CSRF-TOKEN': Laravel.csrfToken,
        },
        success : function(data) {
          console.log(data);
          $('#mtitle').text(data['name']);
          $('#mdesc').text(data['description']);
          $('#mlocal').text(data['place']);
          $('#mdate').text(formatDate( new Date( data['date'] )));
          $('#mcal').modal();
        }
      })
    }
  </script>
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
        function formatDate(date){
          var dia = date.getDate();
          if (dia.toString().length == 1)
            dia = "0"+dia;
          var mes = date.getMonth()+1;
          if (mes.toString().length == 1)
            mes = "0"+mes;
          var ano = date.getFullYear();  
          return dia+"/"+mes+"/"+ano;
      }
        $(function(){
          $('#calendario').fullCalendar({
            eventClick: function(event) {
              /*
                Quando a url é clicada ela é interceptada por 
                essa função, a informação é pega usando ajax e
                é mostrada no modal.
              */
              getData( event.url );
              return false;
            },
            events : 'calendário/',
          });
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


  <div class="modal fade" id="mcal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="mtitle"></h4>
        </div>
        <div class="modal-body" style="overflow: hidden;">
          <p><strong class="vermelho">@lang('messages.cm.place'): </strong><span id="mlocal"></span></p>
          <p><strong class="vermelho">@lang('messages.cm.date'): </strong><span id="mdate"></span></p>
          <hr style="margin-top:10px; margin-bottom:10px;">
          <div id="mdesc" class="nttexto"></div>
        
        </div>
      </div>
    </div>
  </div>
@endsection