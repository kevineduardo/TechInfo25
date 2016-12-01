@extends('layouts.app')

@section('styles')
    @parent
<link type="text/css" rel="stylesheet" href="{{ URL::asset('font-awesome/css/font-awesome.min.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ URL::asset('social_buttons/bootstrap-social.css') }}" />
@endsection

@section('portal')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('messages.layout.login')</div>
                <div class="panel-body">
                <div id="sociallogin" class="col-md-12">
                <div class="col-md-6 col-md-offset-3">
                <a class="btn btn-block btn-social btn-lg btn-facebook" onclick="window.location.href='{{ route('facebook') }}'"><i class="fa fa-facebook"></i>@lang('messages.layout.social.fb')</a>
                <a class="btn btn-block btn-social btn-lg btn-google" onclick="window.location.href='{{ route('google') }}'"><i class="fa fa-google"></i>@lang('messages.layout.social.g')</a>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
