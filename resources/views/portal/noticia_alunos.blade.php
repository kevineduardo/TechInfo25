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
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="{{ URL::asset('js/jquery.js') }}"></script>
	<script src="{{ URL::asset('tinymce/tinymce.min.js') }}"></script>
	  <script>
	  tinymce.init({ 
	    selector:'textarea#text',
	    theme: 'modern',
	    content_css: '{{ URL::asset('css/bootstrap.min.css') }}',
	    height: 300,
		readonly: true,
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
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
					},
					type:'POST',
					url:'/portal/notícias/getdata',
					data:'id=' + id,
					success:function(data){
					//console.log(data);
					if ( data ) {
						$(".notid").attr("value",""+id)
						$("#title").attr("value",data['name'])
						$("#subtitle").attr("value",data['desc'])
						tinyMCE.activeEditor.setContent(data['text']);
						$("#ap_noticia").modal('show')
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
@if($success)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.post.title')</strong> @lang('messages.form.success.post.msg')
</div>
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
			  </tr>
			</thead>
			@if(count($noticias) != 0)
			@foreach ($noticias as $not)
        	<tr style="cursor: pointer;" onclick="getNotData({!! $not['id']; !!})">
			    <td>{{ str_limit($not->title, 10) }}</td>
			    <td>{{ str_limit($not->subtitle, 10) }}</td>
			    <td>{{ str_limit($not->author->name, 20) }}</td>
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
        <fieldset class="form-horizontal">
            <div class="form-group">
                <label for="title">@lang('messages.form.news.title')</label>
                <input readonly autocomplete="off" class="form-control" id=
                "title" name="title" placeholder="Boas novas!"
                required="" type="text" value="">
            </div>
            <div class="form-group">
                <label for="subtitle">@lang('messages.form.news.subtitle')</label>
                <input readonly autocomplete="off" class="form-control" id=
                "subtitle" name="subtitle" placeholder=
                "Temos novidades..." required="" type="text" value="">
            </div>
            <div class="form-group">
                <label for="text">@lang('messages.form.news.text')</label> 
                <textarea readonly id="text" name="text"></textarea>
            </div>
            <div class="form-group">
				<form method="post" class="form-horizontal">
					{{ csrf_field() }}
					<input type="hidden" class="notid" name="id" value=""></input>
					<button class="btn btn-success" type="submit" name="publicar">@lang('messages.aprov.a')</button>
					<button class="btn btn-danger" type="submit" name="deletar">@lang('messages.aprov.d')</button>
				</form>
            </div>
        </fieldset>
        </div>
      </div>
    </div>
  </div>
@endsection