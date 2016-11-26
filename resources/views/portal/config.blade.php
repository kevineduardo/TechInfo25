@extends('layouts.portal')

@section('title', trans('messages.layout.config'))

@section('styles')
  @parent
  <style type="text/css">
.form-group {
        margin-right: 0px !important;
        margin-left: 0px !important;
        }
        form {
          margin-top: 5px;
        }
  </style>
@endsection

@section('javascripts')
	@parent
  <script src="{{ URL::asset('jqueryui/jquery-ui.min.js') }}"></script>
  <script src="{{ URL::asset('js/interact.min.js') }}"></script>
    <script>
      var triggered = false;
      $(document).ready (function(){
            $(".alert-success").fadeTo(2200, 500).slideUp(500, function(){
            $(".alert-success").slideUp(500);
            });
            $(".alert-danger").fadeTo(10000, 500).slideUp(500, function(){
            $(".alert-danger").slideUp(500);
            });
            $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
              var target = $(e.target).attr("href") // activated tab
              if (target == "#turmas") {
                triggered = true;
                localStorage.triggered = true;
                hidesidebar();
              } else {
                if(triggered == true) {
                  showsidebar();
                }
              }
            });

            if (typeof localStorage.triggered !== 'undefined') {
              if(localStorage.triggered == "true") {
                triggered = true;
                activaTab('turmas');
                hidesidebar();
              }
            }
      });

      function activaTab(tab){
        $('.nav-pills a[href="#' + tab + '"]').tab('show');
      };

      function hidesidebar() {
        $( "#menusidebar" ).animate({
                width: "hide",
                height: "hide",
              }, 700, function() {
                $( "#menusidebar" ).css({
                    'display': 'none',
                });
                $('#conteudogeral').switchClass( "col-md-9", "col-md-12", 300, "easeInOutQuad" );
              });
      }

      function showsidebar() {
        localStorage.triggered = false;
        $('#conteudogeral').switchClass( "col-md-12", "col-md-9", 300, "easeInOutQuad" );
        $( "#menusidebar" ).animate({
                width: "show",
                height: "show",
              }, 700, function() {
                $( "#menusidebar" ).css({
                    'display': 'initial',
                });
              });
      }

      function getTurmaData(id) {
        $.ajax(
        {
          headers: {
            'X-CSRF-TOKEN': Laravel.csrfToken,
          },
          type:'GET',
          url:'{{ route('ajax.turma') }}/' + id,
          success:function(data){
          if ( data ) {
            $("#selected").attr("value", id);
            $("#enumber").attr("value", data['number']);
            $("#evariant").attr("value", data['variant']);
            $("#editarturma").modal('show');
          }
           }
        }
        );
      }
    </script>
@endsection

@section('content')
@if (count($errors) > 0)
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.errors.save')</strong>
  <ul>
  @foreach ($errors->all() as $error)
  	<li>{{ $error }}</li>
  @endforeach
  </ul>
</div>
@endif
@if(isset($success))
@if($success)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.saved.title')</strong> @lang('messages.form.success.saved.msg')
</div>
@endif
@endif
@if(isset($et))
@if($et)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.tedited.title')</strong> @lang('messages.form.success.tedited.msg')
</div>
@endif
@endif
@if(isset($dt))
@if($dt)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.tdeleted.title')</strong> @lang('messages.form.success.tdeleted.msg')
</div>
@endif
@endif
  <div class="col-md-9">
  <div class="tab-content">
    <div id="config" class="tab-pane fade in active">
      <form class="form-horizontal" method="post">
        {{ csrf_field() }}
        <fieldset>
            <div class="form-group">
                <label for="sitename">@lang('messages.form.settings.site_name')</label>
                <input type="hidden" name="settings" value="1">
                <input autocomplete="off" class="form-control" id=
                "sitename" name="site_name" placeholder="@lang('messages.phs.site_name')"
                required="" type="text" value="@if($settings['site_name']){{$settings['site_name']}}@endif">
            </div>
            {{--
            <div class="form-group">
              <label for="mnt">@lang('messages.form.settings.mnt')</label>
              <select id="mnt" class="form-control" name="maintenance" class="form-control">
                <option @if($settings['maintenance'] == "true") selected @endif value="1">Ativado</option>
                <option @if($settings['maintenance'] == "false") selected @endif value="0">Desativado</option>
              </select>
            </div>
            --}}
            <div class="form-group">
                <label for="fb">@lang('messages.form.settings.fb')</label>
                <input autocomplete="off" class="form-control" id=
                "fb" name="facebook_page_url" placeholder="@lang('messages.phs.fb_url')"
                required="" type="text" value="@if($settings['facebook_page_url']){{urldecode($settings['facebook_page_url'])}}@endif">
            </div>
            <div class="form-group">
                <label for="portal_a">@lang('messages.form.settings.pa')</label>
                <select id="portal_a" class="form-control" name="portal_activated" class="form-control">
                <option @if($settings['portal_activated'] == "true") selected @endif value="1">Ativado</option>
                <option @if($settings['portal_activated'] == "false") selected @endif value="0">Desativado</option>
              </select>
            </div>
            <div class="form-group">
                <label for="sfooter">@lang('messages.form.settings.footer')</label>
                <input autocomplete="off" class="form-control" id=
                "sfooter" name="footer" placeholder="@lang('messages.phs.sfooter')"
                required="" type="text" value="@if($settings['footer']){{$settings['footer']}}@endif">
            </div>
            <div class="form-group">
                <button class="btn btn-success center-block" type="submit">@lang('messages.form.save')</button>
            </div>
        </fieldset>
      </form>
    </div>
    <div id="turmas" class="tab-pane fade">
            <table class="table table-hover">
            <thead>
        <tr>
          <th><span class="vermelho">@lang('messages.cm.class')</span></th>
          <th><span class="vermelho">@lang('messages.cm.inityear')</span></th>
        </tr>
      </thead>
      @if(count($turmas) != 0)
      <button type="button" style="margin-top: 5px;" class="btn btn-primary" data-toggle="modal" data-target="#novaturma">@lang('messages.buttons.novaturma')</button>
      @foreach ($turmas as $turma)
          <tr style="cursor: pointer;" onclick="getTurmaData({{ $turma['id'] }})">
          <td>@if($turma->variant) {{ $turma->number . $turma->variant }} @else {{ $turma->number }} @endif</td>
          <td>{{ Carbon\Carbon::parse($turma->inityear)->format('d/m/Y') }}</td>
        </tr>
        @endforeach
      @else
      <tr class="text-center">
        @if(str_contains(Route::currentRouteName(), 'search'))
          <td colspan="4">@lang('messages.t.nr')</td>
          @else
          <td colspan="4">@lang('messages.t.ne')</td>
          @endif
      </tr>
      @endif
      </table>
      <div class="text-center">
      {{ $turmas->links() }}
      </div>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
  </div>
  <vr>
  <div class="col-md-3">
  <ul class="nav nav-pills nav-stacked">
    <li class="active"><a data-toggle="pill" href="#config">@lang('messages.layout.settings')</a></li>
    <li><a data-toggle="pill" href="#turmas">@lang('messages.layout.classes')</a></li>
    <li><a data-toggle="pill" href="#menu2">Em breve</a></li>
    <li><a data-toggle="pill" href="#menu3">Em breve</a></li>
  </ul>
</div>
  <div class="modal fade" id="novaturma" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.newclass')</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post">
        {{ csrf_field() }}
        <fieldset class="form-horizontal">
            <div class="form-group">
                <label for="number">@lang('messages.form.class.number')</label>
                <input type="hidden" name="newclass" value="1">
                <input autocomplete="off" class="form-control" id=
                "number" name="number" placeholder="@lang('messages.phs.turma_number')"
                required="" type="number" min="100" max="999" value="">
            </div>
            <div class="form-group">
                <label for="variant">@lang('messages.form.class.variant')</label>
                <input autocomplete="off" class="form-control" id=
                "variant" name="variant" placeholder="@lang('messages.phs.turma_variant')"  type="text" value="">
            </div>
            <div class="form-group">
                <button class="btn btn-success center-block" type="submit">@lang('messages.buttons.salvarturma')</button>
            </div>
        </fieldset>
      </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editarturma" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.editclass')</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post">
        {{ csrf_field() }}
        <fieldset>
            <div class="form-group">
                <label for="number">@lang('messages.form.class.number')</label>
                <input type="hidden" name="editclass" value="1">
                <input type="hidden" id="selected" name="selected" value="">
                <input autocomplete="off" class="form-control" id=
                "enumber" name="number" placeholder="@lang('messages.phs.turma_number')"
                required="" type="number" min="100" max="999" value="">
            </div>
            <div class="form-group">
                <label for="variant">@lang('messages.form.class.variant')</label>
                <input autocomplete="off" class="form-control" id=
                "evariant" name="variant" placeholder="@lang('messages.phs.turma_variant')"  type="text" value="">
            </div>
            <div class="form-group">
                <button class="btn btn-success" name="salvar" value="true" type="submit">@lang('messages.buttons.salvarturma')</button>
                <button class="btn btn-danger" name="deletar" value="true" type="submit">@lang('messages.buttons.deletarturma')</button>
            </div>
        </fieldset>
      </form>
        </div>
      </div>
    </div>
  </div>
@endsection