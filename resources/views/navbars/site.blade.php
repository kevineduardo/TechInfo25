<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menuprincipal" aria-expanded="false">
            <span class="sr-only">@lang('messages.layout.tn')</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="navbar-collapse collapse" id="menuprincipal" aria-expanded="false" style="height: 1px;">
          <ul class="nav navbar-nav">
            @if(isset($categories))
            @each('navbars.partials.dropdown', $categories, 'category')
            @else
            <li class="dropdown">
            <li class="active"><a href="#">@lang('messages.layout.home') <span class="sr-only">(current)</span></a></li>
        </li>
            @endif
            </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-pencil"></span> @lang('messages.portal')</a></li>
          </ul>
    </div>
    </div>
    </nav>