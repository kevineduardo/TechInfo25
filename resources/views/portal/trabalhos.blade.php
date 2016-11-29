@extends('layouts.portal')

@section('title', trans('messages.layout.homeworks'))

@section('styles')
  @parent
  <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-select.min.css') }}" />
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
      @if($professor)
      function getTrabalhoData(id) {
        $.ajax(
        {
          headers: {
            'X-CSRF-TOKEN': Laravel.csrfToken,
          },
          type:'GET',
          url:'{{ route('ajax.trabalho') }}/' + id,
          success:function(data){
          if ( data ) {
            $("#selected").attr("value", id);
            $('#esubject').selectpicker('val', data['subject_id']);
            $('#eclass').selectpicker('val', data['class_id']);
            $('#etitle').attr('value', data['title']);
            jQuery('#edata').datetimepicker({
              value:data['deadline'],
              format:'d/m/Y H:i',
            });
            $("#editartrabalho").modal('show');
          }
           }
        }
        );
      }
      @else
      function getTrabalhoDataAluno(id) {
        $.ajax(
        {
          headers: {
            'X-CSRF-TOKEN': Laravel.csrfToken,
          },
          type:'GET',
          url:'{{ route('ajax.trabalho') }}/' + id,
          success:function(data){
          if ( data ) {
            console.log(data);
            $('#dl').attr('href',"{{ url('/') }}/" + data['path']);
            $("#dltrabalho").modal('show');
          }
           }
        }
        );
      }
      @endif
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
  <strong>@lang('messages.form.success.trsaved.title')</strong> @lang('messages.form.success.trsaved.msg')
</div>
@endif
@endif
@if(isset($msg))
@if($msg == 1)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.tredited.title')</strong> @lang('messages.form.success.tredited.msg')
</div>
@endif
@if($msg == 2)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.trdeleted.title')</strong> @lang('messages.form.success.trdeleted.msg')
</div>
@endif
@endif
<div id="trabalhos">
	@if($professor)
      <button type="button" style="margin-top: 5px;" class="btn btn-primary" data-toggle="modal" data-target="#novotrabalho">@lang('messages.buttons.novotrabalho')</button>
    @endif
      <table class="table table-hover">
            <thead>
        <tr>
          <th><span class="vermelho">@lang('messages.cm.homework')</span></th>
          <th><span class="vermelho">@lang('messages.cm.subject')</span></th>
          <th><span class="vermelho">@lang('messages.cm.class')</span></th>
          @if(!$professor)
          <th><span class="vermelho">@lang('messages.cm.teacher')</span></th>
          @endif
          <th><span class="vermelho">@lang('messages.cm.deadline')</span></th>
        </tr>
      </thead>
      @if(count($trabalhos) != 0)
      @foreach ($trabalhos as $trabalho)
      	@if($professor)
          <tr style="cursor: pointer;" onclick="getTrabalhoData({{ $trabalho->id }})">
        @else
          <tr style="cursor: pointer;" onclick="getTrabalhoDataAluno({{ $trabalho->id }})">
        @endif
          <td> {{ $trabalho->title }}</td>
          <td>{{ $trabalho->subject->name }}</td>
          <td>@if($trabalho->classe->variant) {{ $trabalho->classe->number . $trabalho->classe->variant }} @else {{ $trabalho->classe->number }} @endif</td>
          @if(!$professor)
          <td>{{ str_limit($trabalho->teacher->user->name,20) }}</td>
          @endif
          <td> {{ Carbon\Carbon::parse($trabalho->deadline)->format('d/m/Y') }}</td>
        </tr>
        @endforeach
      @else
      <tr class="text-center">
        @if(str_contains(Route::currentRouteName(), 'search'))
          <td colspan="4">@lang('messages.tr.nr')</td>
          @else
          <td colspan="4">@lang('messages.tr.ne')</td>
          @endif
      </tr>
      @endif
      </table>
      <div class="text-center">
      {{ $trabalhos->links() }}
      </div>
</div>
@if($professor)
<div class="modal fade" id="novotrabalho" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.newhomework')</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <fieldset class="form-horizontal">
            <div class="form-group">
              <label for="subject">@lang('messages.form.homework.subject')</label>
              <input type="hidden" name="newhomework" value="1">
              <select id="subject" class="form-control selectpicker" data-live-search="true" name="subject_id" class="form-control" title="@lang('messages.stl.subject')">
                @foreach($subjects as $subject)
                <option value="{{ $subject->subject->id }}">{{ $subject->subject->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="class">@lang('messages.form.homework.class')</label>
              <select id="class" class="form-control selectpicker" data-live-search="true" name="class_id" class="form-control" title="@lang('messages.stl.class')">
                @foreach($classes as $classe)
                <option value="{{ $classe->classe->id }}">@if($classe->classe->variant) {{ $classe->classe->number . $classe->classe->variant }} @else {{ $classe->classe->number }} @endif</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="title">@lang('messages.form.homework.hm')</label>
              <input type="text" class="form-control" autocomplete="off" id="title" name="title" placeholder="@lang('messages.phs.homeworktitle')">
            </div>
            <div class="form-group">
              <label for="arq">@lang('messages.form.homework.arq')</label>
                <label class="btn btn-default btn-file">
                    @lang('messages.buttons.arq') <input type="file" id="arq" name="arquivo" style="display: none;">
                </label>
                <p class="help-block">@lang('messages.helpblock.arq2')</p>
            </div>
            <div class="form-group">
              <label for="data">@lang('messages.form.homework.deadline')</label>
              <div class="input-group date">
                    <input id="data" name="data" type="text" class="form-control">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
              </div>
            </div>
            <div class="form-group">
                <button class="btn btn-success center-block" type="submit">@lang('messages.buttons.salvartrabalho')</button>
            </div>
        </fieldset>
      </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editartrabalho" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.edithomework')</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <fieldset class="form-horizontal">
            <div class="form-group">
              <label for="esubject">@lang('messages.form.homework.subject')</label>
              <input type="hidden" id="selected" name="selected" value="">
              <input type="hidden" name="edithomework" value="1">
              <select id="esubject" class="form-control selectpicker" data-live-search="true" name="subject_id" class="form-control" title="@lang('messages.stl.subject')">
                @foreach($subjects as $subject)
                <option value="{{ $subject->subject->id }}">{{ $subject->subject->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="eclass">@lang('messages.form.homework.class')</label>
              <select id="eclass" class="form-control selectpicker" data-live-search="true" name="class_id" class="form-control" title="@lang('messages.stl.class')">
                @foreach($classes as $classe)
                <option value="{{ $classe->classe->id }}">@if($classe->classe->variant) {{ $classe->classe->number . $classe->classe->variant }} @else {{ $classe->classe->number }} @endif</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="etitle">@lang('messages.form.homework.hm')</label>
              <input type="text" class="form-control" autocomplete="off" id="etitle" name="title" placeholder="@lang('messages.phs.homeworktitle')">
            </div>
            <div class="form-group">
              <label for="arq">@lang('messages.form.homework.arq')</label>
                <label class="btn btn-default btn-file">
                    @lang('messages.buttons.arq') <input type="file" id="arq" name="arquivo" style="display: none;">
                </label>
                <p class="help-block">@lang('messages.helpblock.arq2')</p>
            </div>
            <div class="form-group">
              <label for="edata">@lang('messages.form.homework.deadline')</label>
              <div class="input-group date">
                    <input id="edata" name="data" type="text" class="form-control">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
              </div>
            </div>
            <div class="form-group">
                <button class="btn btn-success" name="salvar" value="1" type="submit">@lang('messages.buttons.salvartrabalho')</button>
                <button class="btn btn-danger" name="deletar" value="1" type="submit">@lang('messages.buttons.deletartrabalho')</button>
            </div>
        </fieldset>
      </form>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ URL::asset('js/bootstrap-select.min.js') }}"></script>
  <script src="{{ URL::asset('js/i18n/defaults-pt_BR.js') }}"></script>
@else
<div class="modal fade" id="dltrabalho" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.dlhomework')</h4>
        </div>
        <div class="modal-body">
        <h3 style="text-align: center;">@lang('messages.dialog.dltrabalho')</h3>
        <a id="dl" href="" style="text-decoration: none;">
        <button class="btn btn-success center-block" name="salvar" value="1" type="submit">@lang('messages.buttons.dltrabalho')</button></a>
        </div>
      </div>
    </div>
  </div>
@endif
@endsection