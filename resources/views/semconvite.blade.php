@extends('layouts.app')

@section('styles')
    @parent
<link type="text/css" rel="stylesheet" href="{{ URL::asset('font-awesome/css/font-awesome.min.css') }}" />
@endsection

@section('portal')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('messages.layout.login')</div>
                <div class="panel-body">
                <div class="center-block">
                    <h3 class="center-block" style="text-align: center;">@lang('messages.layout.alunoauth')</h3>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
