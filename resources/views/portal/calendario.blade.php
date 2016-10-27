@extends('layouts.portal')

@section('title', trans('messages.layout.calendar'))

@section('javascript')
  <script>
    function getCalendarData(id) {
      $.ajax({
        headers: 
        { 
            'X-CSRF-TOKEN': Laravel.csrfToken,
        },
        url : '/portal/calendário/' + id
      });
    }
  </script>
@endsection

@section('content')
  <div class="col-md-12" style="text-align: right;">
    <button class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span>&nbsp;@lang('messages.buttons.novadata')
    </button>
  </div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>
          <span class="vermelho">@lang('messages.cm.title')</span>
        </th>
        <th>
          <span class="vermelho">@lang('messages.cm.place')</span>
        </th>
        <th>
          <span class="vermelho">@lang('messages.cm.created')</span>
        </th>
        <th>
          <span class="vermelho">@lang('messages.cm.date')</span>
        </th>
      </tr>
    </thead>
    <tbody>
    @foreach( $datas as $data )
      <tr style="cursor: pointer;" onclick="getCalendarData(89)">
        <td>
          {{ $data['name'] }}
        </td>
        <td>
          {{ $data['place'] }}
        </td>
        <td>
          {{ $data['user']->name }}
        </td>
        <td>
          {{ $data['date']->format('m/d/Y') }}
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  <div class="col-md-12" style="text-align: center;">
    {{ $datas->links() }}
  </div>
@endsection