@extends('layouts.portal')

@section('title', 'Notícias')

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
	<script src="{{ URL::asset('tinymce/tinymce.min.js') }}"></script>
	  <script>
	  tinymce.init({ 
	    selector:'textarea#text',
	    theme: 'modern',
	    content_css: '{{ URL::asset('css/bootstrap.min.css') }}',
	    height: 300,
	    language: 'pt_BR',
	    plugins: [
	    "advlist autolink lists link image charmap print preview anchor",
	    "searchreplace visualblocks code fullscreen",
	    "insertdatetime media table contextmenu paste jbimages"
	  ],
	  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	  relative_urls: false
	     });
	    
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
@if($professor)
{!! Form::open(array('route' => 'notícias.search', 'class'=>'form form-inline col-md-7')) !!}
@else
{!! Form::open(array('route' => 'notícias.search', 'class'=>'form form-inline col-md-10')) !!}
@endif
	<div class="input-group input-group-md">
    {!! Form::text('title', null,
                           array('required',
                                'class'=>'form-control col-xs-4',
                                'placeholder'=>trans('messages.phs.buscar'))) !!}
    <div class="input-group-btn">
     {!! Form::submit(trans('messages.buttons.buscar'),
                                array('class'=>'btn btn-default')) !!}
    </div>
    </div>
 {!! Form::close() !!}
 @if($professor)
 <button type="button" onclick="window.location='{{ route('notícias.alunos')}}';" style="margin-top: 5px;" class="btn btn-primary col-md-3">@lang('messages.buttons.palunos')</button>
 <button type="button" style="margin-top: 5px;" class="btn btn-primary col-md-2" data-toggle="modal" data-target="#novanoticia">@lang('messages.buttons.novanoticia')</button>
 @else
 <button type="button" style="margin-top: 5px;" class="btn btn-primary col-md-2" data-toggle="modal" data-target="#novanoticia">@lang('messages.buttons.novanoticia')</button>
 @endif
</div>
<div id="noticias">
            <table class="table table-hover">
            <thead>
			  <tr>
			  	@if($professor)
			    <th>@lang('messages.cm.title')</th>
			    <th>@lang('messages.cm.subtitle')</th>
			    <th>@lang('messages.cm.author')</th>
			    <th>@lang('messages.cm.created_at')</th>
			    @else
			    <th>@lang('messages.cm.title')</th>
			    <th>@lang('messages.cm.subtitle')</th>
			    <th>@lang('messages.cm.approved')</th>
			    @endif
			  </tr>
			</thead>
			@if(count($noticias) != 0)
			@foreach ($noticias as $not)
        	<tr>
        		@if($professor)
			    <td>{{ str_limit($not->title, 10) }}</td>
			    <td>{{ str_limit($not->subtitle, 10) }}</td>
			    <td>{{ str_limit($not->author->name, 20) }}</td>
			    <td>{{ $not->created_at->format('d/m/Y') }}</td>
			    @else
			    <td>{{ str_limit($not->title, 10) }}</td>
			    <td>{{ str_limit($not->subtitle, 10) }}</td>
			    @if($not->published)
			    <td>@lang('messages.b.yes')</td>
			    @else
			    <td>@lang('messages.b.no')</td>
			    @endif
			    @endif
			  </tr>
    		@endforeach
			@else
			<tr class="text-center">
				@if($professor)
				@if(str_contains(Route::currentRouteName(), 'search'))
			    <td colspan="4">@lang('messages.n.nr')</td>
			    @else
			    <td colspan="4">@lang('messages.n.ne')</td>
			    @endif
			    @else
			    @if(str_contains(Route::currentRouteName(), 'search'))
			    <td colspan="4">@lang('messages.n.nr')</td>
			    @else
			    <td colspan="4">@lang('messages.n.np')</td>
			    @endif
			    @endif
			</tr>
			@endif
			</table>
			<div class="text-center">
			{{ $noticias->links() }}
			</div>
</div>
  <div class="modal fade" id="novanoticia" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.newnews')</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post">
        {{ csrf_field() }}
        <fieldset>
            <div class="form-group">
                <label for="title">@lang('messages.form.news.title')</label>
                <input autocomplete="off" class="form-control" id=
                "title" name="title" placeholder="Boas novas!"
                required="" type="text" value="">
            </div>
            <div class="form-group">
                <label for="subtitle">@lang('messages.form.news.subtitle')</label>
                <input autocomplete="off" class="form-control" id=
                "subtitle" name="subtitle" placeholder=
                "Temos novidades..." required="" type="text" value="">
            </div>
            <div class="form-group">
                <label for="text">@lang('messages.form.news.text')</label> 
                <textarea id="text" name="text"></textarea>
            </div>
            <div class="form-group">
                <div class="radio">
                    <label><input checked id="published" name="published" type=
                    "radio" value="true"> @lang('messages.form.publish.true')</label>
                </div>
                <div class="radio">
                    <label><input id="published" name="published" type="radio" value=
                    "false"> @lang('messages.form.publish.false')</label>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">@lang('messages.form.save')</button>
            </div>
        </fieldset>
    	</form>
        </div>
      </div>
    </div>
  </div>
@endsection