@extends('layouts.portal')

@section('title', trans('messages.layout.grades'))

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
      });
      function getNotaData(id) {
        $.ajax(
        {
          headers: {
            'X-CSRF-TOKEN': Laravel.csrfToken,
          },
          type:'GET',
          url:'{{ route('ajax.nota') }}/' + id,
          success:function(data){
          if ( data ) {
            $("#selected").attr("value", id);
            $('#estudent').selectpicker('val', data['student_id']);
            $('#esubject').selectpicker('val', data['subject_id']);
            $('#eclass').selectpicker('val', data['class_id']);
            $('#egrade').attr('value', data['grade']);
            $("#editarnota").modal('show');
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
  <strong>@lang('messages.form.success.gsaved.title')</strong> @lang('messages.form.success.gsaved.msg')
</div>
@endif
@endif
@if(isset($msg))
@if($msg == 1)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.gedited.title')</strong> @lang('messages.form.success.gedited.msg')
</div>
@endif
@if($msg == 2)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.gdeleted.title')</strong> @lang('messages.form.success.gdeleted.msg')
</div>
@endif
@endif
<div id="notas">
	@if($professor)
      <button type="button" style="margin-top: 5px;" class="btn btn-primary" data-toggle="modal" data-target="#novanota">@lang('messages.buttons.novanota')</button>
    @endif
      <table class="table table-hover">
            <thead>
        <tr>
          <th><span class="vermelho">@lang('messages.cm.grade')</span></th>
          <th><span class="vermelho">@lang('messages.cm.subject')</span></th>
          <th><span class="vermelho">@lang('messages.cm.class')</span></th>
          @if($professor)
          <th><span class="vermelho">@lang('messages.cm.student')</span></th>
          @else
          <th><span class="vermelho">@lang('messages.cm.teacher')</span></th>
          @endif
        </tr>
      </thead>
      @if(count($notas) != 0)
      @foreach ($notas as $nota)
      	@if($professor)
          <tr style="cursor: pointer;" onclick="getNotaData({{ $nota->id }})">
        @endif
          <td> {{ $nota->grade }}</td>
          <td>{{ $nota->subject->name }}</td>
          <td>@if($nota->classe->variant) {{ $nota->classe->number . $nota->classe->variant }} @else {{ $nota->classe->number }} @endif</td>
          @if($professor)
          <td>{{ str_limit($nota->student->user->name,20) }}</td>
          @else
          <td>{{ str_limit($nota->teacher->user->name,20) }}</td>
          @endif
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
      {{ $notas->links() }}
      </div>
</div>
@if($professor)
<div class="modal fade" id="novanota" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.newgrade')</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post">
        {{ csrf_field() }}
        <fieldset class="form-horizontal">
            <div class="form-group">
              <label for="student">@lang('messages.form.grade.student')</label>
              <input type="hidden" name="newgrade" value="1">
              <select id="student" class="form-control selectpicker" data-live-search="true" name="student_id" class="form-control" title="@lang('messages.stl.student')">
                @foreach($students as $student)
                <option value="{{ $student->id }}"> {{ $student->user->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="subject">@lang('messages.form.grade.subject')</label>
              <select id="subject" class="form-control selectpicker" data-live-search="true" name="subject_id" class="form-control" title="@lang('messages.stl.subject')">
                @foreach($subjects as $subject)
                <option value="{{ $subject->subject->id }}">{{ $subject->subject->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="class">@lang('messages.form.grade.class')</label>
              <select id="class" class="form-control selectpicker" data-live-search="true" name="class_id" class="form-control" title="@lang('messages.stl.class')">
                @foreach($classes as $classe)
                <option value="{{ $classe->classe->id }}">@if($classe->classe->variant) {{ $classe->classe->number . $classe->classe->variant }} @else {{ $classe->classe->number }} @endif</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="grade">@lang('messages.form.grade.gd')</label>
              <input type="text" class="form-control" id="grade" name="grade" placeholder="@lang('messages.phs.grade')">
            </div>
            <div class="form-group">
                <button class="btn btn-success center-block" type="submit">@lang('messages.buttons.salvarnota')</button>
            </div>
        </fieldset>
      </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editarnota" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.newgrade')</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post">
        {{ csrf_field() }}
        <fieldset class="form-horizontal">
            <div class="form-group">
              <label for="estudent">@lang('messages.form.grade.student')</label>
              <input type="hidden" name="editgrade" value="1">
              <input type="hidden" id="selected" name="selected" value="">
              <select id="estudent" class="form-control selectpicker" data-live-search="true" name="student_id" class="form-control" title="@lang('messages.stl.student')">
                @foreach($students as $student)
                <option value="{{ $student->id }}"> {{ $student->user->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="esubject">@lang('messages.form.grade.subject')</label>
              <select id="esubject" class="form-control selectpicker" data-live-search="true" name="subject_id" class="form-control" title="@lang('messages.stl.subject')">
                @foreach($subjects as $subject)
                <option value="{{ $subject->subject->id }}">{{ $subject->subject->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="eclass">@lang('messages.form.grade.class')</label>
              <select id="eclass" class="form-control selectpicker" data-live-search="true" name="class_id" class="form-control" title="@lang('messages.stl.class')">
                @foreach($classes as $classe)
                <option value="{{ $classe->classe->id }}">@if($classe->classe->variant) {{ $classe->classe->number . $classe->classe->variant }} @else {{ $classe->classe->number }} @endif</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="egrade">@lang('messages.form.grade.gd')</label>
              <input type="text" class="form-control" id="egrade" name="grade" placeholder="@lang('messages.phs.grade')">
            </div>
            <div class="form-group">
                <button class="btn btn-success" name="salvar" value="1" type="submit">@lang('messages.buttons.salvarnota')</button>
                <button class="btn btn-danger" name="deletar" value="1" type="submit">@lang('messages.buttons.deletarnota')</button>
            </div>
        </fieldset>
      </form>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ URL::asset('js/bootstrap-select.min.js') }}"></script>
  <script src="{{ URL::asset('js/i18n/defaults-pt_BR.js') }}"></script>
@endif
@endsection