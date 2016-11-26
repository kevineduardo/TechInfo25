@extends('layouts.site')

@section('title', $settings['site_name'] . ' - ' . trans( 'messages.layout.contact' ))

@section('styles')
  @parent
  <style>
  .p {
    font-family: Arial;
    font-size: 16px;
  }
  </style>
@endsection

@section('javascript')
  @parent
  <script>
    function limparCampos() {
      $('#mnome').val('');
      $('#memail').val('');
      $('#mess').val('');
    }
  </script>
@endsection

@section('content')
<div id="principal" class="table-responsive col-md-8">
    <table class="table">
      <thead>
      <tr>
      <th><span class="vermelho">@lang('messages.layout.contact')</span></th>
      </tr>
      </thead>
      <tbody class="normal">
      <tr><th>

      @foreach($contato as $c)
        <p class="p"><strong>{{ $c['name'] }}:</strong>&nbsp;{{ $c['value'] }}</p>
      @endforeach
      
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