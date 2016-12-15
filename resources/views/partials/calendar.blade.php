<tr>
	<th>
		<div class="calendario" onclick="window.location = '/calendário#{{ $calendario->id }}';">
			<span class="vermelho">{{ $calendario->date->format('d/m/Y') }}</span><br/>
			<small>{{ $calendario->name}}<a style="float:right;" href="/calendário#{{ $calendario->id }}">Ver mais</a></small>
		</div>
	</th>
</tr>