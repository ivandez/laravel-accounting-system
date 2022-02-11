@extends('base')

@section('content')

    <div class="container">

        <div class="row my-3 justify-content-center align-items-center">
            <div class="col">
                <x-deudas-por-pagar :data="$deudasPorPagar"/>
            </div>
            <div class="col">
                <x-deudas-por-cobrar :data="$deudasPorCobrar"/>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <x-most-seller-clients :clients="$clientesMasVentas"/>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-most-seller-products :products="$products"/>
            </div>
        </div>



    </div>
@endsection
