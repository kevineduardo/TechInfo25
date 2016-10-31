@extends('layouts.site')

@section('title', $settings['site_name'] . ' - ' . trans( 'messages.layout.contact' ))

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
        <form action="" method="post">
          {{ csrf_field() }}
          <fieldset class="form-horizontal">

          <div class="form-group">
            <label for="name">@lang('messages.layout.cname')</label>
            <input class="form-control" type="text" id="mnome" name="name" />
          </div>

          <div class="form-group">
            <label for="email">@lang('messages.layout.cemail')</label>
            <input class="form-control" type="email" id="memail" name="email" />
          </div>

          <hr>

          <div class="form-group">
            <label for="email">@lang('messages.layout.csubj')</label>
            <input class="form-control" type="text" id="msubject" name="subject" />
          </div>

          <div class="form-group">
            <label for="message">@lang('messages.layout.cmessage')</label>
            <textarea style="resize:vertical; height:200px; min-height:200px; max-height:400px;" class="form-control" name="message" id="mess"></textarea>
          </div>

          <div class="form-group">
            <div style="float: right;">
              <button type="button" onclick="limparCampos()" class="btn btn-default">@lang('messages.buttons.clear')</button>
              <button type="submit" class="btn btn-success">@lang('messages.buttons.send')</button>
            </div>
          </div>

          </fieldset>
        </form>
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