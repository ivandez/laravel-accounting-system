<table class="table" id="products-table">
    <thead>
    <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Opciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tags as $tag)
        <tr>
            <th>{{$tag->name}}</th>
            <td id="opciones">
                @if(auth()->user()->rol == 1)

                <a href="{{ route('tag.edit', $tag->id) }}" type="button" class="btn btn-primary">Editar</a>

                <form action="{{ route('tag.destroy', $tag) }}" class="d-inline" method="post">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
