<table class="table">
    <thead>
    <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Teléfono</th>
        <th scope="col">Documento</th>
        <th scope="col">Comentario</th>
        <th scope="col">Opciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clients as $client)
        <tr>
            <th>{{$client->first_name}}</th>
            <td>{{$client->last_name}}</td>
            <td>{{$client->phone_number}}</td>
            <td>{{$client->documentType?->type . $client->document }}</td>
            <td>{{$client->comment}}</td>
            <td>
                <a href="{{ route('clients.edit', $client->id) }}" type="button" class="btn btn-primary">Editar</a>
                <form action="{{ route('clients.destroy', $client) }}" class="d-inline" method="post">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
