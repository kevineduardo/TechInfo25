<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menuprincipal" aria-expanded="false">
            <span class="sr-only">Visualizar navegação</span>
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
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-home"></span> Início <span class="caret"></span></a>
          <ul class="dropdown-menu">
                <li><a href="inicio"><span class="glyphicon glyphicon-list-alt"></span> Início</a></li>
          </ul>
        </li>
            @endif
            </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-pencil"></span> Portal do Aluno</a></li>
          </ul>
    </div>
    </div>
    </nav>