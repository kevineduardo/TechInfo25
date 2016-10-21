
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
<script>
      function getUserData(id) {
        $.ajax(
        {
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          type:'GET',
          url:'/portal/usuários/' + id,
          success:function(data){
          if ( data ) {
            console.log(data);
            $(".userid").attr("value", id);
            $("#usernome").attr("value", data['name']);
            $("#useremail").attr("value", data['email']);
            $("#useroauth").attr("value", data['oauth_provider']);
            if(data['teacher'] == true) {
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
@endsection

@section('content')
@if (count($errors) > 0)
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.errors.post')</strong>
  <ul>
  @foreach ($errors->all() as $error)
  	<li>{{ $error }}</li>
  @endforeach
  </ul>
</div>
@endif
@if(isset($success))
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.post.title')</strong> @lang('messages.form.success.post.msg')
</div>
@endif
<div id="controles" style="margin-bottom: 5px;">
{!! Form::open(array('route' => 'usuários.search', 'class'=>'form form-inline col-md-5')) !!}
	<div class="input-group input-group-md">
    {!! Form::text('title', null,
                           array('required',
                                'class'=>'form-control col-xs-4',
                                'placeholder'=>trans('messages.phs.buscaru'))) !!}
    <div class="input-group-btn">
     {!! Form::submit(trans('messages.buttons.buscar'),
                                array('class'=>'btn btn-default')) !!}
    </div>
    </div>
 {!! Form::close() !!}
 <button type="button" onclick="window.location='{{-- route('usuários-alunos.index') --}}';" style="margin-top: 5px;" class="btn btn-primary col-md-3">@lang('messages.buttons.alunosinvite')</button>
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
          <h4 class="modal-title">@lang('messages.titles.newuser')</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(array('route' => 'usuários.update', 'class'=>'form form-horizontal')) !!}
            {!! Form::text('name', null,
                                   array('required',
                                        'class'=>'form-control',
                                        'placeholder'=>trans('messages.layout.firstname'))) !!}
             {!! Form::submit(trans('messages.buttons.salvaruser'),
                                        array('class'=>'btn btn-success')) !!}
          {!! Form::submit(trans('messages.buttons.deletaruser'),
                                        array('class'=>'btn btn-danger')) !!}
         {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection