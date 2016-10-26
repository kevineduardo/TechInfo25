
@extends('layouts.portal')

@section('title', trans('messages.layout.usersinvite'))

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
  <script src="{{ URL::asset('js/jquery.js') }}"></script>
<script>
      function getUserData(id) {
        $.ajax(
        {
          headers: {
            'X-CSRF-TOKEN': Laravel.csrfToken,
          },
          type:'GET',
          url:'/portal/usuários-alunos/' + id,
          success:function(data){
          if ( data ) {
            $(".userid").attr("value", id);
            $("#email").attr("value", data['email']);
            $("#delconvite").modal('show');
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
  <strong>@lang('messages.form.success_user.invite.title')</strong> @lang('messages.form.success_user.invite.msg')
</div>
@endif
@endif
@if(isset($deleted))
@if($deleted)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success_user.delete.title')</strong> @lang('messages.form.success_user.delete.msg')
</div>
@endif
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
 <button type="button" style="margin-top: 5px;" class="btn btn-primary col-md-2 col-md-offset-5" data-toggle="modal" data-target="#novoconvite">@lang('messages.buttons.novoconvite')</button>
</div>
<div id="usuarios">
            <table class="table table-hover">
            <thead>
			  <tr>
			    <th><span class="vermelho">@lang('messages.cm.email')</span></th>
			    <th><span class="vermelho">@lang('messages.cm.class')</span></th>
			    <th><span class="vermelho">@lang('messages.cm.resp')</span></th>
			  </tr>
			</thead>
			@if(count($usuarios) != 0)
			@foreach ($usuarios as $user)
        	<tr style="cursor: pointer;" onclick="getUserData({{ $user['id'] }})">
			    <td>{{ str_limit($user->email, 40) }}</td>
			    <td>@if($user->classe->variant) {{ $user->classe->number . $user->classe->variant }} @else {{ $user->classe->number }} @endif</td>
			    <td>{{ str_limit($user->teacher->user->name, 40) }}</td>
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
  {{-- form de deletar convite de user --}}
  <div class="modal fade" id="delconvite" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.deleteinvite')</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="{{ route('usuários-alunos.update') }}" class="form-horizontal">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <fieldset class="form-horizontal">
            <p>@lang('messages.dialog.deleteinvite')</p>
            <div class="form-group">
          <input type="hidden" class="userid" name="id" value=""></input>
          <button class="btn btn-danger center-block" type="submit" name="deletar" value="true">@lang('messages.buttons.deletarconvite')</button>
            </div>
        </fieldset>
        </form>
        </div>
      </div>
    </div>
  </div>
  {{-- form de adicionar convite --}}
  <div class="modal fade" id="novoconvite" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.newinvite')</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post">
        {{ csrf_field() }}
        <fieldset>
            <div class="form-group">
                <label for="title">@lang('messages.form.userinvite.email')</label>
                <input autocomplete="off" class="form-control" id=
                "email" name="email" placeholder="educando@25dejulho.com"
                required="" type="email" value="">
            </div>
            <div class="form-group">
              <label for="class">@lang('messages.form.userinvite.class')</label>
              <select id="class" class="form-control" name="class_id" class="form-control">
                @foreach($classes as $class)
                <option value="{{ $class->id }}">@if($class->variant) {{ $class->number . $class->variant }} @else {{ $class->number }} @endif</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
                <button class="btn btn-success center-block" type="submit">@lang('messages.form.save')</button>
            </div>
        </fieldset>
    	</form>
        </div>
      </div>
    </div>
  </div>
@endsection