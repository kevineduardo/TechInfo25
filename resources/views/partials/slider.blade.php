<li style="background-color: #EEE; border-radius: 5px;">
	@if( isset($n['empty']) )
		<img class="notimg" src="{{ URL::asset( 'img\slider\empty.jpg' ) }}" alt="@lang('messages.alt.img')" />
	@else
	<a href="/notícias/{{ $n['noticia']->id }}">
		<center><p class="vermelho" style="margin-bottom: 2px;">
			{{ $n['noticia']->title }}
		</p></center>
		<img class="notimg" src="{{ $n['imagem'] }}" alt="{{ $n['noticia']->titulo }}" title="{{ $n['noticia']->titulo }}" />
	</a>
	@endif
</li>