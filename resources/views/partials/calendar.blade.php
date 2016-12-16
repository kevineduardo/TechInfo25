<tr>
	<th>
		<div class="calendario" onclick="window.location = '/calendário#{{ $calendario->id }}';">
			<span class="vermelho">{{ $calendario->date->format('d/m/Y') }}</span><br/>
			<small>{{ $calendario->name}}</small>
		</div>
	</th>
</tr>