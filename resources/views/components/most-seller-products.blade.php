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
            @for($i = 0; $i < 3; $i++)
                <tr>
                    <th scope="col">{{ $products[$i]['name'] }}</th>
                    <th scope="col">{{ $products[$i]['quantity'] }}</th>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
</div>
