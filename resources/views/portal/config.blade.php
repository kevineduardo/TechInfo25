@extends('layouts.portal')

@section('title', trans('messages.layout.config'))


@section('javascripts')
	@parent
	<script src="{{ URL::asset('js/jquery.js') }}"></script>
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
  <strong>@lang('messages.form.success.post.title')</strong> @lang('messages.form.success.post.msg')
</div>
@endif
@endif
@if(isset($editado))
@if($editado)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>@lang('messages.form.success.edited.title')</strong> @lang('messages.form.success.edited.msg')
</div>
@endif
@endif
  <div class="col-md-9">
  <div class="tab-content">
    <div id="config" class="tab-pane fade in active">
      <form class="form-horizontal" method="post">
        {{ csrf_field() }}
        <fieldset>
            <div class="form-group">
                <label for="sitename">@lang('messages.form.settings.site_name')</label>
                <input autocomplete="off" class="form-control" id=
                "sitename" name="site_name" placeholder="@lang('messages.phs.site_name')"
                required="" type="text" value="@if($settings['site_name']) {{ $settings['site_name'] }} @endif">
            </div>
            <div class="form-group">
              <label for="mnt">@lang('messages.form.settings.mnt')</label>
              <select id="mnt" class="form-control" name="maintenance" class="form-control">
                <option @if($settings['maintenance'] == "true") selected @endif value="1">Ativado</option>
                <option @if($settings['maintenance'] == "false") selected @endif value="0">Desativado</option>
              </select>
            </div>
            <div class="form-group">
                <label for="fb">@lang('messages.form.settings.fb')</label>
                <input autocomplete="off" class="form-control" id=
                "fb" name="facebook_page_url" placeholder="@lang('messages.phs.fb_url')"
                required="" type="text" value="@if($settings['facebook_page_url']) {{ urldecode($settings['facebook_page_url']) }} @endif">
            </div>
            <div class="form-group">
                <label for="portal_a">@lang('messages.form.settings.pa')</label>
                <select id="portal_a" class="form-control" name="portal_activated" class="form-control">
                <option @if($settings['portal_activated'] == "true") selected @endif value="1">Ativado</option>
                <option @if($settings['portal_activated'] == "false") selected @endif value="0">Desativado</option>
              </select>
            </div>
            <div class="form-group">
                <label for="sfooter">@lang('messages.form.settings.footer')</label>
                <input autocomplete="off" class="form-control" id=
                "sfooter" name="footer" placeholder="@lang('messages.phs.sfooter')"
                required="" type="text" value="@if($settings['footer']) {{ $settings['footer'] }} @endif">
            </div>
            <div class="form-group">
                <button class="btn btn-success center-block" type="submit">@lang('messages.form.save')</button>
            </div>
        </fieldset>
      </form>
    </div>
    <div id="turmas" class="tab-pane fade">
      <h3>Turmas</h3>
      <p>TRETA.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
  </div>
  <vr>
  <div class="col-md-3">
  <ul class="nav nav-pills nav-stacked">
    <li class="active"><a data-toggle="pill" href="#config">@lang('messages.layout.settings')</a></li>
    <li><a data-toggle="pill" href="#turmas">@lang('messages.layout.classes')</a></li>
    <li><a data-toggle="pill" href="#menu2">Menu 2</a></li>
    <li><a data-toggle="pill" href="#menu3">Menu 3</a></li>
  </ul>
</div>
@endsection