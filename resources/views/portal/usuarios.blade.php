
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
 <button type="button" onclick="window.location='{{ route('usuários.alunos')}}';" style="margin-top: 5px;" class="btn btn-primary col-md-3">@lang('messages.buttons.alunosinvite')</button>
 <button type="button" style="margin-top: 5px;" class="btn btn-primary col-md-2 col-md-offset-1" data-toggle="modal" data-target="#novousuario">@lang('messages.buttons.novousuario')</button>
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
			@foreach ($usuarios as $not)
        	<tr>
			    <td>{{ str_limit($not->name, 10) }}</td>
			    <td>{{ str_limit($not->email, 10) }}</td>
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
  <div class="modal fade" id="novousuario" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.newuser')</h4>
        </div>
        <div class="modal-body">
        Fazer aqui o form
        </div>
      </div>
    </div>
  </div>
@endsection