@extends('layouts.portal')

@section('title', trans('messages.layout.news'))

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
	     <script>
			function getNotData(id) {
				var action = "{{ route('notícias.index') }}";
				$("#editando").attr("action", action + '/' + id);
				console.log($("#editando").attr("action", action + '/' + id));
				$.ajax(
				{
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
					},
					type:'GET',
					url:'/portal/notícias/' + id,
					success:function(data){
					if ( data ) {
						console.log(data);
						$("#etitle").attr("value", data['title']);
						$("#esubtitle").attr("value", data['subtitle']);
						tinyMCE.activeEditor.setContent(data['text']);
						if(data['published'] == true) {
							$("#epublicado").prop("checked", true);
						} else {
							$("#erascunho").prop("checked", true);
						}
						$("#edit_noticia").modal('show');
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
@if(isset($editado))
@if($editado)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.edited.title')</strong> @lang('messages.form.success.edited.msg')
</div>
@endif
@endif
@if(isset($deletado))
@if($deletado)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.delete.title')</strong> @lang('messages.form.success.delete.msg')
</div>
@endif
@endif
<div id="controles" style="margin-bottom: 5px;">
@if($professor)
{!! Form::open(array('route' => 'notícias.search', 'class'=>'form form-inline col-md-5')) !!}
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
 <button type="button" onclick="window.location='{{ route('alunos.index')}}';" style="margin-top: 5px;" class="btn btn-primary col-md-3">@lang('messages.buttons.palunos')</button>
 <button type="button" style="margin-top: 5px;" class="btn btn-primary col-md-2 col-md-offset-1" data-toggle="modal" data-target="#novanoticia">@lang('messages.buttons.novanoticia')</button>
 @else
 <button type="button" style="margin-top: 5px;" class="btn btn-primary col-md-2" data-toggle="modal" data-target="#novanoticia">@lang('messages.buttons.novanoticia')</button>
 @endif
</div>
<div id="noticias">
            <table class="table table-hover">
            <thead>
			  <tr>
			  	@if($professor)
			    <th><span class="vermelho">@lang('messages.cm.title')</span></th>
			    <th><span class="vermelho">@lang('messages.cm.subtitle')</span></th>
			    <th><span class="vermelho">@lang('messages.cm.author')</span></th>
			    <th><span class="vermelho">@lang('messages.cm.created_at')</span></th>
			    @else
			    <th><span class="vermelho">@lang('messages.cm.title')</span></th>
			    <th><span class="vermelho">@lang('messages.cm.subtitle')</span></th>
			    <th><span class="vermelho">@lang('messages.cm.approved')</span></th>
			    @endif
			  </tr>
			</thead>
			@if(count($noticias) != 0)
			@foreach ($noticias as $not)
        	<tr style="cursor: pointer;" onclick="getNotData({{ $not['id'] }})">
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
  <div class="modal fade" id="edit_noticia" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.editnews')</h4>
        </div>
        <div class="modal-body">
        <form id="editando" method="post" class="form-horizontal" action="{{ route('notícias.index') }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <fieldset>
            <div class="form-group">
                <label for="title">@lang('messages.form.news.title')</label>
                <input autocomplete="off" class="form-control" id=
                "etitle" name="title" placeholder="Boas novas!"
                required="" type="text" value="">
            </div>
            <div class="form-group">
                <label for="subtitle">@lang('messages.form.news.subtitle')</label>
                <input autocomplete="off" class="form-control" id=
                "esubtitle" name="subtitle" placeholder=
                "Temos novidades..." required="" type="text" value="">
            </div>
            <div class="form-group">
                <label for="text">@lang('messages.form.news.text')</label> 
                <textarea id="text" name="text"></textarea>
            </div>
            <div class="form-group">
                <div class="radio">
                    <label><input id="epublicado" name="published" type=
                    "radio" value="1"> @lang('messages.form.epublish.true')</label>
                </div>
                <div class="radio">
                    <label><input id="erascunho" name="published" type="radio" value=
                    "0"> @lang('messages.form.epublish.false')</label>
                </div>
            </div>
            <div class="form-group">
					<button class="btn btn-success" type="submit" name="salvar" value="true">@lang('messages.buttons.salvarnot')</button>
					<button class="btn btn-danger" type="submit" name="deletar" value="true">@lang('messages.buttons.deletarnot')</button>
            </div>
        </fieldset>
    	</form>
        </div>
      </div>
    </div>
  </div>
@endsection