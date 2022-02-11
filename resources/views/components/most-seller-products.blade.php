<div class="card text-center">
    <div class="card-header">
        Productos más vendidos
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <td>Producto</td>
                <td>Cantidad vendidas</td>
            </tr>
            </thead>
            <tbody>
            @if(count($products) > 0)
                @if(count($products) < 3)
                    @foreach($products as $p)
                        <tr>
                            <th scope="col">{{ $p['name'] }}</th>
                            <th scope="col">{{ $p['quantity'] }}</th>
                        </tr>
                    @endforeach
                @else
                    @for($i = 0; $i < 3; $i++)
                        <tr>
                            <th scope="col">{{ $products[$i]['name'] }}</th>
                            <th scope="col">{{ $products[$i]['quantity'] }}</th>
                        </tr>
                    @endfor
                @endif

            @else
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
