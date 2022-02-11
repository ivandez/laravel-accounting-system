<div class="card text-center">
    <div class="card-header">
        Clientes con más ventas
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <td>Nombre</td>
                <td>Compras</td>
            </tr>
            </thead>
            <tbody>
            @if(count($clients) > 0)
                @if(count($clients) < 3)
                    @foreach($clients as $p)
                        <tr>
                            <th scope="col">{{ $p['client'] }}</th>
                            <th scope="col">{{ $p['count'] }}</th>
                        </tr>
                    @endforeach
                @else
                    @for($i = 0; $i < 3; $i++)
                        <tr>
                            <th scope="col">{{ $products[$i]['client'] }}</th>
                            <th scope="col">{{ $products[$i]['count'] }}</th>
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
