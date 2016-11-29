@extends('layouts.portal')

@section('title', trans('messages.layout.events'))

@section('styles')
  @parent
  <link rel="stylesheet" href="{{ URL::asset('css/jquery.datetimepicker.css') }}" />
  <style type="text/css">
.form-group {
  margin-right: 0px !important;
  margin-left: 0px !important;
}
form {
  margin-top: 5px;
}
textarea {
  max-width: 100%; 
}
  </style>
@endsection

@section('javascripts')
	@parent
  <script src="{{ URL::asset('jqueryui/jquery-ui.min.js') }}"></script>
  <script src="{{ URL::asset('js/jquery.datetimepicker.full.min.js') }}"></script>
    <script>
      var triggered = false;
      $(document).ready (function(){
            $(".alert-success").fadeTo(2200, 500).slideUp(500, function(){
            $(".alert-success").slideUp(500);
            });
            $(".alert-danger").fadeTo(10000, 500).slideUp(500, function(){
            $(".alert-danger").slideUp(500);
            });

            jQuery.datetimepicker.setLocale('pt-BR');
            jQuery('#data').datetimepicker({
             format:'d/m/Y H:i'
            });
      });
      function getEventoData(id) {
        $.ajax(
        {
          headers: {
            'X-CSRF-TOKEN': Laravel.csrfToken,
          },
          type:'GET',
          url:'{{ route('ajax.evento') }}/' + id,
          success:function(data){
          if ( data ) {
            console.log(data);
            $("#selected").attr("value", id);
            $('#ename').attr('value', data['name']);
            $('#edescription').text(data['description']);
            $('#eplace').attr('value', data['place']);
            jQuery('#edata').datetimepicker({
              value:data['date'],
              format:'d/m/Y H:i',
            });
            $("#editarevento").modal('show');
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
  <strong>@lang('messages.form.success.esaved.title')</strong> @lang('messages.form.success.esaved.msg')
</div>
@endif
@endif
@if(isset($msg))
@if($msg == 1)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.eedited.title')</strong> @lang('messages.form.success.eedited.msg')
</div>
@endif
@if($msg == 2)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.edeleted.title')</strong> @lang('messages.form.success.edeleted.msg')
</div>
@endif
@endif
<div id="eventos">
      <button type="button" style="margin-top: 5px;" class="btn btn-primary" data-toggle="modal" data-target="#novoevento">@lang('messages.buttons.novoevento')</button>
      <table class="table table-hover">
            <thead>
        <tr>
          <th><span class="vermelho">@lang('messages.cm.name')</span></th>
          <th><span class="vermelho">@lang('messages.cm.desc')</span></th>
          <th><span class="vermelho">@lang('messages.cm.date')</span></th>
        </tr>
      </thead>
      @if(count($eventos) != 0)
      @foreach ($eventos as $evento)
          <tr style="cursor: pointer;" onclick="getEventoData({{ $evento->id }})">
          <td> {{ str_limit($evento->name, 20) }}</td>
          <td>{{ str_limit($evento->description,40) }}</td>
          <td>{{ Carbon\Carbon::parse($evento->date)->format('d/m/Y') }}</td>
        </tr>
        @endforeach
      @else
      <tr class="text-center">
        @if(str_contains(Route::currentRouteName(), 'search'))
          <td colspan="4">@lang('messages.nn.nr')</td>
          @else
          <td colspan="4">@lang('messages.nn.ne')</td>
          @endif
      </tr>
      @endif
      </table>
      <div class="text-center">
      {{ $eventos->links() }}
      </div>
</div>
<div class="modal fade" id="novoevento" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.newevent')</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post">
        {{ csrf_field() }}
        <fieldset class="form-horizontal">
            <div class="form-group">
              <label for="name">@lang('messages.form.event.name')</label>
              <input type="hidden" name="newevent" value="1">
              <input type="text" class="form-control" required="" autocomplete="off" id="name" name="name" placeholder="@lang('messages.phs.eventname')">
            </div>
            <div class="form-group">
              <label for="description">@lang('messages.form.event.desc')</label>
              <textarea id="description" class="form-control" autocomplete="off" required="" name="description" placeholder="@lang('messages.phs.eventdesc')"></textarea>
            </div>
            <div class="form-group">
              <label for="place">@lang('messages.form.event.place')</label>
              <input type="text" class="form-control" required="" autocomplete="off" id="place" name="place" placeholder="@lang('messages.phs.eventplace')">
            </div>
            <div class="form-group">
              <label for="data">@lang('messages.form.event.date')</label>
              <div class="input-group date">
                    <input id="data" name="data" type="text" class="form-control">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
              </div>
            </div>
            <div class="form-group">
                <button class="btn btn-success center-block" type="submit">@lang('messages.buttons.salvarevento')</button>
            </div>
        </fieldset>
      </form>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="editarevento" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.editevent')</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post">
        {{ csrf_field() }}
        <fieldset class="form-horizontal">
            <div class="form-group">
              <label for="ename">@lang('messages.form.event.name')</label>
              <input type="hidden" name="editevent" value="1">
              <input type="hidden" id="selected" name="selected" value="">
              <input type="text" class="form-control" required="" autocomplete="off" id="ename" name="name" placeholder="@lang('messages.phs.eventname')">
            </div>
            <div class="form-group">
              <label for="edescription">@lang('messages.form.event.desc')</label>
              <textarea id="edescription" class="form-control" autocomplete="off" required="" name="description" placeholder="@lang('messages.phs.eventdesc')"></textarea>
            </div>
            <div class="form-group">
              <label for="eplace">@lang('messages.form.event.place')</label>
              <input type="text" class="form-control" required="" autocomplete="off" id="eplace" name="place" placeholder="@lang('messages.phs.eventplace')">
            </div>
            <div class="form-group">
              <label for="edata">@lang('messages.form.event.date')</label>
              <div class="input-group date">
                    <input id="edata" name="data" type="text" class="form-control">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
              </div>
            </div>
            <div class="form-group">
                <button class="btn btn-success" name="salvar" value="1" type="submit">@lang('messages.buttons.salvarevento')</button>
                <button class="btn btn-danger" name="deletar" value="1" type="submit">@lang('messages.buttons.deletarevento')</button>
            </div>
        </fieldset>
      </form>
        </div>
      </div>
    </div>
  </div>
@endsection