@extends('base')

@section('content')

    <div class="container">

        <div class="row mt-3">
            <div class="col">
                <h3>Balance</h3>
            </div>
        </div>

        @if (session('success'))
            <div class="row my-3">
                <div class="col">
                    <x-alert variant="alert-success" message="{{ session('success') }}"/>
                </div>
            </div>
        @endif

        @if (!$empresa->name)
            <div class="row my-3">
                <div class="col">
                    <x-alert variant="alert-warning" message="Necesitas configurar la información de la empresa para crear una venta, por favor ve a Empresa y llena el formulario"/>
                </div>
            </div>
        @endif

        <div class="row mt-3">
            <div class="col d-flex align-items-center justify-content-center">
                <x-utility-card :ventasTotales="$ventasTotales" :gastosTotales="$gastosTotales" :utilidadTotal="$utilidadTotal"/>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <x-search-bar url="{{ route('sales.query') }}"/>
            </div>
        </div>

        @if ($empresa->name)
        <div class="row mt-3">
            <div class="col">
                <a href="{{ route('sales.create') }}" type="button" class="btn btn-success">Agregar nueva venta</a>
            </div>
        </div>
        @endif

        <div class="row mt-3">
            <div class="col">
                <x-sales-table :sales="$sales"/>
            </div>
        </div>

        <div class="row text-center">
            <div class="col">
                {{ $sales->links() }}
            </div>
        </div>

    </div>

@endsection
