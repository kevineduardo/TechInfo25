@extends('layouts.portal')

@section('title', 'Portal')

@section('content')
<div class="text-center">
<h3 class="vermelho">@lang('messages.layout.welcome')</h3>
</div>
<div class="panel panel-info" style="margin-top: 30px;">
                <div class="panel-heading">@lang('messages.layout.news')</div>

                <div class="panel-body">
                    @include('portal.partials.noticias')
                </div>
            </div>
@endsection