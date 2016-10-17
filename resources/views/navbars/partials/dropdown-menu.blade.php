@if($pages['type'] == 1)
<li>
<a href="{{ route('pagina', ['id' => $pages['id']]) }}">
<span class="glyphicon {{ $pages['navbar_icon'] }}"></span> {{ $pages['title']}}</a>
</li>
@else
<li>
<a href="{{ URL::asset($pages['custom_url']) }}">
<span class="glyphicon {{ $pages['navbar_icon'] }}"></span> {{ $pages['title']}}</a>
</li>
@endif