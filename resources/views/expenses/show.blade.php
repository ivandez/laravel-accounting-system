@extends('base')

@section('content')

    <div class="container">

        <div class="d-grid gap-3">

            <!--        ADDED PRODUCTS TABLE-->
            <div class="row">
                <div class="col">
                    <table class="table striped">
                        <thead>
                        <tr>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">CANTIDAD</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sale->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="client" class="form-label">Cliente: </label>
                    <input readonly class="form-control" type="text" value="{{ $sale->client?->first_name }}">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="date" class="form-label">Fecha: </label>
                    <input readonly class="form-control" type="text" value="{{ $sale->date}}">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-check">
                        @if($sale->is_paid)
                            <input readonly checked class="form-check-input" type="radio">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Pagado
                            </label>
                        @else
                            <input readonly class="form-check-input" type="radio">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Por pagar
                            </label>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="metodo_de_pago" class="form-label">Método de pago: </label>
                    <input readonly class="form-control" type="text" value="{{ $sale->paymentMethod->name }}">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="comentario" class="form-label">Comentario</label>
                    <textarea readonly class="form-control" id="comentario" rows="3" v-model="form.comentario">{{ $sale->comment }}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <a type="button" class="btn btn-danger" href="{{ route('expense.index') }}">Volver atrás</a>
                </div>
            </div>
        </div>

    </div>

@endsection
