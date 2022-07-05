<table class="table" id="printTable">
    <thead>
    <tr>
        <th scope="col">Cliente o proveedor</th>
        <th scope="col">Serial</th>
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
            <th>{{$sale->serial_number}}</th>
            <th>${{$sale->sumProductPrice()}}</th>
            <th>{{$sale->comment}}</th>
            <th>{{$sale->paymentMethod->name}}</th>
            <th>{{ formatDatePls($sale->date) }}</th>
            <td id="opciones">
                <a href="{{ route('sales.show', $sale->id) }}" type="button" class="btn btn-primary">Ver</a>
                <a href="{{ route('sales.getInvoice', $sale) }}" target="_blank" type="button" class="btn btn-success">Recibo</a>
                @if(auth()->user()->rol == 1)
                    <form action="{{ route('sales.destroy', $sale) }}" class="d-inline" method="post">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
