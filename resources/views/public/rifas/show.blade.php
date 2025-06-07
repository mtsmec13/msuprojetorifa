
    <b>Título:</b> {{ $rifa->titulo ?? 'sem título' }}<br>
    <b>Total de números:</b> {{ $rifa->quantidade_numeros ?? 'não definido' }}<br>
    <b>Números ocupados:</b> {{ implode(', ', $numerosOcupados ?? []) }}
</div>
