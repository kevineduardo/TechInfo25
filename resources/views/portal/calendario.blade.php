@extends('layouts.portal')

@section('title', trans('messages.layout.calendar'))

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
  <script>
    function getData(id) {
      $.ajax({
        headers: 
        { 
            'X-CSRF-TOKEN': Laravel.csrfToken,
        },
        url : '/portal/calendário/' + id,
        success : function(data){
          $('#cname').attr('value',data['name']);
          $('#cdesc').text(data['description']);
          $('#editarcalendario').modal();
        },
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
    @if(empty($datas))
      <tr>
        <td colspan="4">@lang('messages.d.nd')</td>
      </tr>
    @else
      @foreach( $datas as $data )
        <tr style="cursor: pointer;" onclick="getData({{ $data['id'] }})">
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
            {{ $data['date']->format('d/m/Y') }}
          </td>
        </tr>
      @endforeach
    @endif
    </tbody>
  </table>
  <div class="col-md-12" style="text-align: center;">
    {{ $datas->links() }}
  </div>

  {{-- form de editar calendario --}}
  <div class="modal fade" id="editarcalendario" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('messages.titles.editcal')</h4>
        </div>
        <div class="modal-body" style="overflow: hidden;">
        <form method="post" action="{{ route('portal.calendario') }}" class="form-horizontal">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <fieldset class="form-horizontal">

          <div class="form-group">
            <label for="name">TITURO</label>
            <input class="form-control" type="text" name="name" id="cname"/>
          </div>

          <div class="form-group">
            <label for="desc">DESCRIÇÂO</label>
            <textarea style="resize:vertical; height: 200px;" class="form-control" name="desc" id="cdesc"></textarea>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-success">SUBMIT</button>
            <button type="submit" class="btn btn-danger">DELETAR</button>
          </div>
        </fieldset>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection