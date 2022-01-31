<table class="table">
    <thead>
    <tr>
        <th scope="col">Cliente o proveedor</th>
        <th scope="col">Monto</th>
        <th scope="col">Comentario</th>
        <th scope="col">Método de pago</th>
        <th scope="col">Fecha</th>
        <th scope="col">Opciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sales as $sale)
        <tr>
            <th>{{$sale->client?->first_name}}</th>
            <th>${{$sale->sumProductPrice()}}</th>
            <th>{{$sale->comment}}</th>
            <th>{{$sale->paymentMethod->name}}</th>
            <th>{{ formatDatePls($sale->date) }}</th>
            <td>
                <a href="{{ route('sales.show', $sale->id) }}" type="button" class="btn btn-primary">Ver</a>
                <form action="{{ route('sales.destroy', $sale) }}" class="d-inline" method="post">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
