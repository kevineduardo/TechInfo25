
@extends('layouts.portal')

@section('title', trans('messages.layout.users'))

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
<script>
      function getUserData(id) {
        $.ajax(
        {
          headers: {
            'X-CSRF-TOKEN': Laravel.csrfToken,
          },
          type:'GET',
          url:'{{ route('usuários.index') }}/' + id,
          success:function(data){
          if ( data ) {
            $(".userid").attr("value", id);
            $("#name").attr("value", data['name']);
            if(data['teacher'] != null) {
              $("#teacher").prop("checked", true);
            } else {
              $("#notteacher").prop("checked", true);
            }
            $("#editarusuario").modal('show');
          }
           }
        }
        );
      }
    </script>
    <script>
      $(document).ready (function(){
            $(".alert-success").fadeTo(2200, 500).slideUp(500, function(){
            $(".alert-success").slideUp(500);
            });
            $(".alert-danger").fadeTo(10000, 500).slideUp(500, function(){
            $(".alert-danger").slideUp(500);
            });
      });
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
  <strong>@lang('messages.form.success_user.edit.title')</strong> @lang('messages.form.success_user.edit.msg')
</div>
@endif
@endif
@if(isset($deletado))
@if($deletado)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success_user.delete.title')</strong> @lang('messages.form.success_user.delete.msg')
</div>
@endif
@endif
<div id="controles" style="margin-bottom: 5px;">
{!! Form::open(array('route' => 'usuários.search', 'class'=>'form form-inline col-md-5')) !!}
	<div class="input-group input-group-md">
    {!! Form::text('name', null,
                           array('required',
                                'class'=>'form-control col-xs-4',
                                'placeholder'=>trans('messages.phs.buscaru'))) !!}
    <div class="input-group-btn">
     {!! Form::submit(trans('messages.buttons.buscar'),
                                array('class'=>'btn btn-default')) !!}
    </div>
    </div>
 {!! Form::close() !!}
 <button type="button" onclick="window.location='{{ route('usuários-alunos.index') }}';" style="margin-top: 5px;" class="btn btn-primary col-md-3">@lang('messages.buttons.usersinvite')</button>
</div>
<div id="usuarios">
            <table class="table table-hover">
            <thead>
			  <tr>
			    <th><span class="vermelho">@lang('messages.cm.name')</span></th>
			    <th><span class="vermelho">@lang('messages.cm.email')</span></th>
			  </tr>
			</thead>
			@if(count($usuarios) != 0)
			@foreach ($usuarios as $user)
        	<tr style="cursor: pointer;" onclick="getUserData({{ $user['id'] }})">
			    <td>{{ str_limit($user->name, 40) }}</td>
			    <td>{{ str_limit($user->email, 40) }}</td>
			  </tr>
    		@endforeach
			@else
			<tr class="text-center">
				@if(str_contains(Route::currentRouteName(), 'search'))
			    <td colspan="4">@lang('messages.u.nr')</td>
			    @else
			    <td colspan="4">@lang('messages.u.ne')</td>
			    @endif
			</tr>
			@endif
			</table>
			<div class="text-center">
			{{ $usuarios->links() }}
			</div>
</div>
  {{-- form de editar user --}}
  <div class="modal fade" id="editarusuario" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.edituser')</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="{{ route('usuários.update') }}" class="form-horizontal">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <fieldset class="form-horizontal">
            <div class="form-group">
                <label for="name">@lang('messages.form.user.name')</label>
                <input autocomplete="off" class="form-control" id=
                "name" name="name"
                required="" type="text" value="">
            </div>
            <div class="form-group">
                <label for="teacher">@lang('messages.form.user.level')</label>
                <div class="radio">
                    <label><input id="teacher" name="teacher" type=
                    "radio" value="1"> @lang('messages.form.teacher.true')</label>
                </div>
                <div class="radio">
                    <label><input id="notteacher" name="teacher" type="radio" value=
                    "0"> @lang('messages.form.teacher.false')</label>
                </div>
            </div>
            <div class="form-group">
          <input type="hidden" class="userid" name="id" value=""></input>
          <button class="btn btn-success" type="submit" name="salvar" value="true">@lang('messages.buttons.salvaruser')</button>
          <button class="btn btn-danger" type="submit" name="deletar" value="true">@lang('messages.buttons.deletaruser')</button>
            </div>
        </fieldset>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection