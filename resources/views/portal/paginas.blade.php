@extends('layouts.portal')

@section('title', trans('messages.layout.pgs'))

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
  </style>
@endsection

@section('javascripts')
	@parent
  <script src="{{ URL::asset('jqueryui/jquery-ui.min.js') }}"></script>
  <script src="{{ URL::asset('tinymce/tinymce.min.js') }}"></script>
  <script>
    tinymce.init({ 
      selector:'textarea',
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
      $(document).ready (function(){
            $(".alert-success").fadeTo(2200, 500).slideUp(500, function(){
            $(".alert-success").slideUp(500);
            });
            $(".alert-danger").fadeTo(10000, 500).slideUp(500, function(){
            $(".alert-danger").slideUp(500);
            });
            $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
              var target = $(e.target).attr("href") // activated tab
              var divz = target.replace("#", "");
              $('div#' + divz + '#cat').selectpicker('val', $('div#' + divz + '#cid').attr('value'));
            });
      });

      function getTurmaData(id) {
        $.ajax(
        {
          headers: {
            'X-CSRF-TOKEN': Laravel.csrfToken,
          },
          type:'GET',
          url:'{{ route('ajax.turma') }}/' + id,
          success:function(data){
          if ( data ) {
            $("#selected").attr("value", id);
            $("#enumber").attr("value", data['number']);
            $("#evariant").attr("value", data['variant']);
            $("#editarturma").modal('show');
          }
           }
        }
        );
      }

      function getCatData(id) {
        $.ajax(
        {
          headers: {
            'X-CSRF-TOKEN': Laravel.csrfToken,
          },
          type:'GET',
          url:'{{ route('ajax.cat') }}/' + id,
          success:function(data){
          if ( data ) {
            $("#selected").attr("value", id);
            $("#ename").attr("value", data['name']);
            $("#eicon").attr("value", data['icon']);
            $("#editarcategoria").modal('show');
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
  <strong>@lang('messages.form.success.csaved.title')</strong> @lang('messages.form.success.csaved.msg')
</div>
@endif
@endif
@if(isset($msg))
@if($msg == 1)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.cedited.title')</strong> @lang('messages.form.success.cedited.msg')
</div>
@endif
@if($msg == 2)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.cdeleted.title')</strong> @lang('messages.form.success.cdeleted.msg')
</div>
@endif
@endif
  <ul class="nav nav-tabs nav-pills" id="myTab">
        <li class="active"> <a href="#cat" data-toggle="tab">@lang('messages.layout.cats')</a>
        </li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">@lang('messages.layout.pgs') <span class="caret"></span></a>

            <ul class="dropdown-menu" role="menu">
                <li><a href="#newpg" data-toggle="tab"><i class="glyphicon glyphicon-asterisk"></i> @lang('messages.buttons.novapagina')</a>
                </li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">@lang('messages.layout.editpg')</li>
                @foreach($paginas as $pagina)
                <li><a href="#{{ $pagina->id }}" data-toggle="tab"><i class="glyphicon {{ $pagina->navbar_icon }}"></i> {{ str_limit($pagina->title, 20) }}</a>
                </li>
                @endforeach
            </ul>
        </li>
    </ul>
    <br>
    <div class="tab-content">
        <div class="tab-pane active" id="cat">
        <table class="table table-hover">
            <thead>
        <tr>
          <th><span class="vermelho">@lang('messages.cm.cat')</span></th>
        </tr>
      </thead>
      @if(count($cats) != 0)
      @foreach ($cats as $cat)
          <tr style="cursor: pointer;" onclick="getCatData({{ $cat->id }})">
          <td><i class="glyphicon {{ $cat->icon }}"></i> {{ $cat->name }}</td>
        </tr>
        @endforeach
      @else
      <tr class="text-center">
          <td colspan="4">@lang('messages.c.ne')</td>
      </tr>
      @endif
      </table>
      <div class="text-center">
      {{ $cats->links() }}
      </div>
      <hr>
      <button type="button" style="margin-top: 5px;" class="btn btn-primary" data-toggle="modal" data-target="#novacategoria">@lang('messages.buttons.novacategoria')</button>
        </div>
        <div class="tab-pane" id="newpg">
        <form class="form-horizontal" method="post">
            {{ csrf_field() }}
        <fieldset class="form-horizontal">
            <div class="form-group">
                <label for="title">@lang('messages.form.pg.title')</label>
                <input type="hidden" name="newpg" value="1">
                <input autocomplete="off" class="form-control" id=
                "title" name="title" placeholder="@lang('messages.phs.pgtitle')"
                required="" type="text" min="5" max="30" value="">
            </div>
            <div class="form-group">
                <label for="navbar_icon">@lang('messages.form.pg.navbar_icon')</label>
                <input autocomplete="off" class="form-control" id=
                "navbar_icon" name="navbar_icon" placeholder="@lang('messages.phs.pgnavbar_icon')"  type="text" required="" value="">
            </div>
            <div class="form-group">
              <label for="cat">@lang('messages.form.pg.cat')</label>
              <select id="cat" class="form-control selectpicker" data-live-search="true" name="category_id" class="form-control">
                @if(count($cats) > 0)
                @foreach($cats as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
                @endif
              </select>
            </div>
            <div class="form-group">
                <label for="custom_url">@lang('messages.form.pg.custom_url')</label>
                <input autocomplete="off" class="form-control" id=
                "custom_url" name="custom_url" placeholder="@lang('messages.phs.pgcustom_url')"  type="text" value="">
                <p class="help-block">@lang('messages.helpblock.custom_url')</p>
            </div>
            <div class="form-group">
                <label for="text">@lang('messages.form.pg.text')</label>
                <textarea autocomplete="off" class="form-control" id="text" name="text" placeholder="@lang('messages.phs.pgtext')"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success" name="salvar" value="1" type="submit">@lang('messages.buttons.salvarpagina')</button>
            </div>
        </fieldset>
      </form>
        </div>
        @foreach($paginas as $pagina)
        <div class="tab-pane" id="{{ $pagina->id }}">
        <form class="form-horizontal" method="post">
            {{ csrf_field() }}
        <fieldset class="form-horizontal">
            <div class="form-group">
                <label for="title">@lang('messages.form.pg.title')</label>
                <input type="hidden" name="editpg" value="1">
                <input type="hidden" name="selected" value="{{ $pagina->id }}">
                <input autocomplete="off" class="form-control" id=
                "title" name="title" placeholder="@lang('messages.phs.pgtitle')"
                required="" type="text" min="5" max="30" value="{{ $pagina->title }}">
            </div>
            <div class="form-group">
                <label for="navbar_icon">@lang('messages.form.pg.navbar_icon')</label>
                <input autocomplete="off" class="form-control" id=
                "navbar_icon" name="navbar_icon" placeholder="@lang('messages.phs.pgnavbar_icon')"  type="text" required="" value="{{$pagina->navbar_icon}}">
            </div>
            <div class="form-group">
                <label for="custom_url">@lang('messages.form.pg.custom_url')</label>
                <input autocomplete="off" class="form-control" id=
                "custom_url" name="custom_url" placeholder="@lang('messages.phs.pgcustom_url')"  type="text" value="@if(!empty($pagina->custom_url)){{ $pagina->custom_url }}@endif">
                <p class="help-block">@lang('messages.helpblock.custom_url')</p>
            </div>
            <div class="form-group">
                <label for="text">@lang('messages.form.pg.text')</label>
                <textarea autocomplete="off" class="form-control" id="text" name="text" placeholder="@lang('messages.phs.pgtext')">@if(!empty($pagina->text)){{ $pagina->text }}@endif</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success" name="salvar" value="1" type="submit">@lang('messages.buttons.salvarpagina')</button>
                <button class="btn btn-danger" name="deletar" value="1" type="submit">@lang('messages.buttons.deletarpagina')</button>
            </div>
        </fieldset>
      </form>
        </div>
        @endforeach
    </div>

    <div class="modal fade" id="novacategoria" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.newcat')</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post">
        {{ csrf_field() }}
        <fieldset class="form-horizontal">
            <div class="form-group">
                <label for="name">@lang('messages.form.cat.name')</label>
                <input type="hidden" name="newcat" value="1">
                <input autocomplete="off" class="form-control" id=
                "name" name="name" placeholder="@lang('messages.phs.catname')"
                required="" type="text" min="5" max="30" value="">
            </div>
            <div class="form-group">
                <label for="icon">@lang('messages.form.cat.icon')</label>
                <input autocomplete="off" class="form-control" id=
                "icon" name="icon" required="" placeholder="@lang('messages.phs.caticon')"  type="text" value="">
            </div>
            <div class="form-group">
                <button class="btn btn-success center-block" type="submit">@lang('messages.buttons.salvarcategoria')</button>
            </div>
        </fieldset>
      </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editarcategoria" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.editcat')</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post">
        {{ csrf_field() }}
        <fieldset class="form-horizontal">
            <div class="form-group">
                <label for="ename">@lang('messages.form.cat.name')</label>
                <input type="hidden" name="editcat" value="1">
                <input type="hidden" id="selected" name="selected" value="">
                <input autocomplete="off" class="form-control" id=
                "ename" name="name" placeholder="@lang('messages.phs.catname')"
                required="" type="text" min="5" max="30" value="">
            </div>
            <div class="form-group">
                <label for="eicon">@lang('messages.form.cat.icon')</label>
                <input autocomplete="off" class="form-control" id=
                "eicon" name="icon" placeholder="@lang('messages.phs.caticon')"  type="text" value="">
            </div>
            <div class="form-group">
                <button class="btn btn-success" name="salvar" value="1" type="submit">@lang('messages.buttons.salvarcategoria')
                </button>
                <button class="btn btn-danger" name="deletar" value="1" type="submit">@lang('messages.buttons.deletarcategoria')</button>
            </div>
        </fieldset>
      </form>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ URL::asset('js/bootstrap-select.min.js') }}"></script>
  <script src="{{ URL::asset('js/i18n/defaults-pt_BR.js') }}"></script>
@endsection