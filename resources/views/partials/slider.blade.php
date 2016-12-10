<li>
	@if( isset($n['empty']) )
		<img class="notimg" src="{{ URL::asset( 'img\slider\empty.jpg' ) }}" alt="@lang('messages.alt.img')" />
	@else
	<a href="/notícias/{{ $n['noticia']->id }}">
		@if( isset($n['imagem']) )
			<img class="notimg" src="{{ $n['imagem'] }}" alt="{{ $n['noticia']->titulo }}" />
		@else
			<img class="notimg" src="{{ URL::asset( 'img\slider\noimg.jpg' ) }}" alt="{{ $n['noticia']->titulo }}" />
		@endif
	</a>
	@endif
</li>