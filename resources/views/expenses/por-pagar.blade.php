@extends('base')

@section('content')

    <div class="container">

        <div class="row mt-3">
            <div class="col">
                <h3>Gastos por pagar</h3>
            </div>
        </div>

        @if (session('success'))
            <div class="row my-3">
                <div class="col">
                    <x-alert variant="alert-success" message="{{ session('success') }}"/>
                </div>
            </div>
        @endif

        <div class="row mt-3">
            <div class="col">
                <x-search-bar url="{{ route('sales.query') }}"/>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <a href="{{ route('expense.create') }}" type="button" class="btn btn-success">Agregar nuevo gasto</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <x-por-pagar-expenses :expenses="$expenses"/>
            </div>
        </div>

    </div>

@endsection
