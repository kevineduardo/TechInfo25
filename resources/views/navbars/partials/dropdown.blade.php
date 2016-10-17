<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon {{ $category['icon'] }}"></span> {{ $category['name']  }} <span class="caret"></span></a>
              <ul class="dropdown-menu">
                  @if(isset($category['pages']))
                  @each('navbars.partials.dropdown-menu', $category['pages'], 'pages')
                  @else
                  @endif
              </ul>
            </li>