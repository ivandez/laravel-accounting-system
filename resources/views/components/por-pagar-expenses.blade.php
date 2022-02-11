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
    @foreach($expenses as $expense)
        <tr>
            <th>{{$expense->provider?->first_name}}</th>
            <th>${{$expense->amount}}</th>
            <th>{{$expense->comment}}</th>
            <th>{{$expense->paymentMethod->name}}</th>
            <th>{{formatDatePls($expense->date)}}</th>
            <td>
                @if(auth()->user()->rol == 1)

                <form action="{{ route('expense.updateStatus', $expense->id) }}" method="post" class="d-inline">
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Pagar</button>
                </form>
                <form action="{{ route('expense.destroy', $expense) }}" class="d-inline" method="post">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
