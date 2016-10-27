@extends('layouts.portal')

@section('title', trans('messages.layout.studentnews'))

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
		readonly: false,
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
				$.ajax(
				{
					headers: {
						'X-CSRF-TOKEN': Laravel.csrfToken,
					},
					type:'GET',
					url:'{{ route('notícias-alunos.index') }}/' + id,
					success:function(data){
					{{-- console.log(data); --}}
					if ( data ) {
						$(".notid").attr("value", id);
						$("#title").attr("value", data['title']);
						$("#subtitle").attr("value", data['subtitle']);
						tinyMCE.activeEditor.setContent(data['text']);
						$("#ap_noticia").modal('show');
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
  <strong>@lang('messages.form.errors.post')</strong>
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
  <strong>@lang('messages.form.success.approved.title')</strong> @lang('messages.form.success.approved.msg')
</div>
@endif
@endif
@if(isset($deleted))
@if($deleted)
<div class="alert alert-dismissible alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.delete.title')</strong> @lang('messages.form.success.delete.msg')
</div>
@endif
@endif
<div id="controles" style="margin-bottom: 5px;">
{!! Form::open(array('route' => 'notícias.alunos.search', 'class'=>'form form-inline col-md-5')) !!}
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
	 
</div>
<div id="noticias">
            <table class="table table-hover">
            <thead>
			  <tr>
			    <th><span class="vermelho">@lang('messages.cm.title')</span></th>
			    <th><span class="vermelho">@lang('messages.cm.subtitle')</span></th>
			    <th><span class="vermelho">@lang('messages.cm.author')</span></th>
			    <th><span class="vermelho">@lang('messages.cm.created_at')</span></th>
			  </tr>
			</thead>
			@if(count($noticias) != 0)
			@foreach ($noticias as $not)
        	<tr style="cursor: pointer;" onclick="getNotData({{ $not['id'] }})">
			    <td>{{ str_limit($not->title, 10) }}</td>
			    <td>{{ str_limit($not->subtitle, 10) }}</td>
			    <td>{{ str_limit($not->author->name, 20) }}</td>
			    <td>{{ $not->created_at->format('d/m/Y') }}</td>
			</tr>
    		@endforeach
			@else
			<tr class="text-center">
				@if(str_contains(Route::currentRouteName(), 'search'))
			    <td colspan="4">@lang('messages.n.nr')</td>
			    @else
			    <td colspan="4">@lang('messages.n.na')</td>
			    @endif
			</tr>
			@endif
			</table>
			<div class="text-center">
			{{ $noticias->links() }}
			</div>
</div>
  <div class="modal fade" id="ap_noticia" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.newnews')</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="{{ route('notícias-alunos.update') }}" class="form-horizontal">
        {{ method_field('PUT') }}
		{{ csrf_field() }}
        <fieldset class="form-horizontal">
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
					<input type="hidden" class="notid" name="id" value=""></input>
					<button class="btn btn-success" type="submit" name="publicar" value="true">@lang('messages.buttons.palunos_salvar')</button>
					<button class="btn btn-danger" type="submit" name="deletar" value="true">@lang('messages.buttons.palunos_descartar')</button>
            </div>
        </fieldset>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection