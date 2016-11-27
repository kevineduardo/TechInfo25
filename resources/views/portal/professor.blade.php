@extends('layouts.portal')

@section('title', trans('messages.layout.teacherdashboard'))

@section('styles')
  @parent
  <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-select.min.css') }}" />
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
                localStorage.ptriggered = "turmas";
              }
            });

            if (typeof localStorage.ptriggered !== 'undefined') {
              if(localStorage.ptriggered == "turmas") {
                activaTab('turmas');
              }
            }
      });

      function activaTab(tab){
        $('.nav-pills a[href="#' + tab + '"]').tab('show');
      };
      function getTurmaData(id) {
        $.ajax(
        {
          headers: {
            'X-CSRF-TOKEN': Laravel.csrfToken,
          },
          type:'GET',
          url:'{{ route('ajax.mturma') }}/' + id,
          success:function(data){
          if ( data ) {
            $("#tselected").attr("value", id);
            $('#eclass').selectpicker('val', data['class_id']);
            $('#esubject').selectpicker('val', data['subject_id']);
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
  <strong>@lang('messages.form.success.infosaved.title')</strong> @lang('messages.form.success.infosaved.msg')
</div>
@endif
@endif
@if(isset($msg))
@if($msg == 1)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.tsaved.title')</strong> @lang('messages.form.success.tsaved.msg')
</div>
@endif
@if($msg == 2)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.tedited.title')</strong> @lang('messages.form.success.tedited.msg')
</div>
@endif
@if($msg == 3)
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
                <label for="bio">@lang('messages.form.teacherdashboard.bio')</label>
                <input type="hidden" name="info" value="1">
                <textarea autocomplete="off" class="form-control" id=
                "bio" name="bio" placeholder="@lang('messages.phs.biografia')"
                required="">@if($bio){{$bio}}@endif</textarea>
            </div>
            <div class="form-group">
                <label for="abg">@lang('messages.form.teacherdashboard.abg')</label>
                <textarea autocomplete="off" class="form-control" id=
                "abg" name="abg" placeholder="@lang('messages.phs.academicbg')"
                required="">@if($abg){{$abg}}@endif</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success center-block" type="submit">@lang('messages.form.save')</button>
            </div>
        </fieldset>
      </form>
    </div>
    <div id="turmas" class="tab-pane fade">
      <button type="button" style="margin-top: 5px;" class="btn btn-primary" data-toggle="modal" data-target="#novaturma">@lang('messages.buttons.novaturma')</button>
      <table class="table table-hover">
            <thead>
        <tr>
          <th><span class="vermelho">@lang('messages.cm.class')</span></th>
          <th><span class="vermelho">@lang('messages.cm.subject')</span></th>
        </tr>
      </thead>
      @if(count($turmas) != 0)
      @foreach ($turmas as $turma)
          <tr style="cursor: pointer;" onclick="getTurmaData({{ $turma->id }})">
          <td>@if($turma->classe->variant) {{ $turma->classe->number . $turma->classe->variant }} @else {{ $turma->classe->number }} @endif</td>
          <td>{{ $turma->subject->name }}</td>
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
  </div>
  </div>
  <vr>
  <div class="col-md-3">
  <ul class="nav nav-pills nav-stacked">
    <li class="active"><a data-toggle="pill" href="#config">@lang('messages.layout.teacherdashboard')</a></li>
    <li><a data-toggle="pill" href="#turmas">@lang('messages.layout.myclasses')</a></li>
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
              <label for="class">@lang('messages.form.teacherdashboard.class')</label>
              <input type="hidden" name="newclass" value="1">
              <select id="class" class="form-control selectpicker" data-live-search="true" name="class_id" class="form-control">
                @foreach($classes as $class)
                <option value="{{ $class->id }}">@if($class->variant) {{ $class->number . $class->variant }} @else {{ $class->number }} @endif</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="subject">@lang('messages.form.teacherdashboard.subject')</label>
              <select id="subject" class="form-control selectpicker" data-live-search="true" name="subject_id" class="form-control">
                @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">@if($subject->name) {{ $subject->name }} @endif</option>
                @endforeach
              </select>
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
              <label for="eclass">@lang('messages.form.teacherdashboard.class')</label>
              <input type="hidden" name="editclass" value="1">
              <input type="hidden" id="tselected" name="selected" value="">
              <select id="eclass" class="form-control selectpicker" data-live-search="true" name="class_id" class="form-control">
                @foreach($classes as $class)
                <option value="{{ $class->id }}">@if($class->variant) {{ $class->number . $class->variant }} @else {{ $class->number }} @endif</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="esubject">@lang('messages.form.teacherdashboard.subject')</label>
              <select id="esubject" class="form-control selectpicker" data-live-search="true" name="subject_id" class="form-control">
                @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">@if($subject->name) {{ $subject->name }} @endif</option>
                @endforeach
              </select>
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
  <script src="{{ URL::asset('js/bootstrap-select.min.js') }}"></script>
  <script src="{{ URL::asset('js/i18n/defaults-pt_BR.js') }}"></script>
@endsection