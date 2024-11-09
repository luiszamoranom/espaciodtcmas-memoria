<div>
    <h2>Listado de backups</h2>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Peso [Mb]</th>
            <th>Fecha</th>
        </tr>
        @foreach($backups as $backup)
            <tr>
                <td>{{ $backup['path'] }}</td>
                <td>{{ $backup['size_in_mb'] }}</td>
                <td>{{ $backup['date'] }}</td>
            </tr>
        @endforeach
    </table>
</div>
