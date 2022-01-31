<table class="table">
    <thead>
    <tr>
        <th scope="col">Proveedor</th>
        <th scope="col">Monto</th>
        <th scope="col">Comentario</th>
        <th scope="col">Método de pago</th>
        <th scope="col">Fecha</th>
        <th scope="col">Opciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($expenses as $expense)
        <tr>
            <th>{{$expense->client?->first_name}}</th>
            <th>${{$expense->amount}}</th>
            <th>{{$expense->comment}}</th>
            <th>{{$expense->paymentMethod->name}}</th>
            <th>{{ formatDatePls($expense->date) }}</th>
            <td>
                <a href="{{ route('sales.show', $expense->id) }}" type="button" class="btn btn-primary">Ver</a>
                <form action="{{ route('sales.destroy', $expense) }}" class="d-inline" method="post">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
