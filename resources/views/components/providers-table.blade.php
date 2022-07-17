<table class="table" id="providers-table">
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
    @foreach($providers as $provider)
        <tr>
            <th>{{$provider->first_name}}</th>
            <td>{{$provider->last_name}}</td>
            <td>{{$provider->phone_number}}</td>
            <td>{{$provider->documentType?->type . $provider->document }}</td>
            <td>{{$provider->comment}}</td>
            <td id="opciones">
                @if(auth()->user()->rol == 1)

                <a href="{{ route('providers.edit', $provider->id) }}" type="button" class="btn btn-primary">Editar</a>
                <form action="{{ route('providers.destroy', $provider) }}" class="d-inline" method="post">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
