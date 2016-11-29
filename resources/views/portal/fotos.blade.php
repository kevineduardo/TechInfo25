@extends('layouts.portal')

@section('title', trans('messages.layout.pictures'))

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
    .img {
        width: 100px; 
        height: 100px; 
        margin: 2px; 
        margin-bottom: 5px;
        overflow: hidden; 
        border-radius: 2px;
        border: solid 3px #3366cc;
        cursor: pointer;
      }
	</style>
@endsection

@section('javascripts')
	@parent
	     <script>
			function getFotoData(id) {
        $.ajax(
        {
          headers: {
            'X-CSRF-TOKEN': Laravel.csrfToken,
          },
          type:'GET',
          url:'{{ route('ajax.foto') }}/' + id,
          success:function(data){
          if ( data ) {
            $("#selected").attr("value", id);
            $("#etitle").attr("value", data['title']);
            $("#edesc").text(data['description']);
            $("#editarfoto").modal('show');
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
  <strong>@lang('messages.form.success.psaved.title')</strong> @lang('messages.form.success.psaved.msg')
</div>
@endif
@endif
@if(isset($msg))
@if($msg == 1)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.pedited.title')</strong> @lang('messages.form.success.pedited.msg')
</div>
@endif
@if($msg == 2)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.pdeleted.title')</strong> @lang('messages.form.success.pdeleted.msg')
</div>
@endif
@endif
<div id="controles">
  <button type="button" style="margin-top: 5px;" class="btn btn-primary" data-toggle="modal" data-target="#novafoto">@lang('messages.buttons.novafoto')</button>
</div>
<hr>
<div>
  @if(count($pics) > 0)
  @foreach($pics as $pic)
              @if(empty($pic->ext_path))
                <img class="imggl2 img" img="{{ $pic->id }}" title="{{ $pic->title }}" onclick="getFotoData({{ $pic['id'] }})" src="{{ URL::asset($pic->path) }}"/>
              @endif
  @endforeach
  @else
  <h3 class="center-block" style="text-align: center;">@lang('messages.f.ne')</h3>
  @endif
  <div class="text-center">
      {{ $pics->links() }}
      </div>
</div>
<div class="modal fade" id="novafoto" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.newpicture')</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <fieldset>
            <div class="form-group">
                <label for="title">@lang('messages.form.pics.title')</label>
                <input type="hidden" name="newpicture" value="1">
                <input autocomplete="off" class="form-control" id=
                "title" name="title" placeholder="@lang('messages.phs.ftitle')"
                required="" type="text" value="">
            </div>
            <div class="form-group">
                <label for="desc">@lang('messages.form.pics.desc')</label>
                <textarea autocomplete="off" class="form-control" id=
                "desc" name="description" placeholder=
                "@lang('messages.phs.fdesc')" required="" style="max-width: 100%;"></textarea>
            </div>
            <div class="form-group">
              <label for="arq">@lang('messages.form.pics.arq')</label>
                <label class="btn btn-default btn-file">
                    @lang('messages.buttons.arq') <input type="file" id="arq" name="arquivo" style="display: none;">
                </label>
                <p class="help-block">@lang('messages.helpblock.arq')</p>
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
<div class="modal fade" id="editarfoto" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.editpicture')</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <fieldset>
            <div class="form-group">
                <label for="etitle">@lang('messages.form.pics.title')</label>
                <input type="hidden" name="editpicture" value="1">
                <input type="hidden" id="selected" name="selected" value="">
                <input autocomplete="off" class="form-control" id=
                "etitle" name="title" placeholder="@lang('messages.phs.ftitle')"
                required="" type="text" value="">
            </div>
            <div class="form-group">
                <label for="edesc">@lang('messages.form.pics.desc')</label>
                <textarea autocomplete="off" class="form-control" id=
                "edesc" name="description" placeholder=
                "@lang('messages.phs.fdesc')" required="" style="max-width: 100%;"></textarea>
            </div>
            <div class="form-group">
              <label for="arq">@lang('messages.form.pics.arq')</label>
                <label class="btn btn-default btn-file">
                    @lang('messages.buttons.arq') <input type="file" id="arq" name="arquivo" style="display: none;">
                </label>
                <p class="help-block">@lang('messages.helpblock.arq')</p>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit" name="salvar" value="1">@lang('messages.buttons.salvarfoto')</button>
                <button class="btn btn-danger" type="submit" name="deletar" value="1">@lang('messages.buttons.deletarfoto')</button>
            </div>
        </fieldset>
      </form>
        </div>
      </div>
    </div>
</div>
@endsection