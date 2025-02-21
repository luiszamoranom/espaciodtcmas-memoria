<div>
    <input type="file" wire:model="archivo">

    <p>{{$respuesta}}</p>
    <button wire:click="subirArchivo">Subir archivo</button>

    @if (!empty($errores))
        <ul>
            @foreach ($errores as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif


    @if (!empty($contenido))
        <table>
            <thead>
            <tr>
                @foreach (array_keys($contenido[0]) as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($contenido as $fila)
                <tr>
                    @foreach ($fila as $celda)
                        <td>{{ $celda }}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
