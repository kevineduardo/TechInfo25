<li>
	@if( isset($n['empty']) )
		<img class="notimg" src="{{ URL::asset( 'img\slider\empty.jpg' ) }}" alt="@lang('messages.alt.img')" />
	@else
	<a href="/notícias/{{ $n['noticia']->id }}">
		<img class="notimg" src="{{ $n['imagem'] }}" alt="{{ $n['noticia']->titulo }}" title="{{ $n['noticia']->titulo }}" />
	</a>
	@endif
</li>