<table class="table">
    <thead>
    <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Código</th>
        <th scope="col">Descripción</th>
        <th scope="col">Precio unitario</th>
        <th scope="col">Costo unitario</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Opciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <th>{{$product->name}}</th>
            <th>{{$product->serial_number}}</th>
            <td>{{$product->description}}</td>
            <td>{{$product->unit_price}}</td>
            <td>{{$product->cost_price}}</td>
            <td>{{$product->quantity}}</td>
            <td>
                @if(auth()->user()->rol == 1)

                <a href="{{ route('products.edit', $product->id) }}" type="button" class="btn btn-primary">Editar</a>

                <form action="{{ route('products.destroy', $product) }}" class="d-inline" method="post">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
