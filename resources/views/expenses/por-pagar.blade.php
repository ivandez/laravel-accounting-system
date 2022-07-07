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
            @if(auth()->user()->rol == 1)

            <div class="col">
                <a href="{{ route('expense.create') }}" type="button" class="btn btn-success">Agregar nuevo gasto</a>
            </div>
            @endif
        </div>

        @if (count($expenses) > 0)
        <div class="row mt-3">
            <div class="col">
                <button type="button" class="btn btn-primary" onclick="printJS({printable: 'expense-table', type: 'html', ignoreElements: ['opciones']})">
                    Impresión rapida
                </button>
        </div>
    @endif

        <div class="row mt-3">
            <div class="col">
                <x-por-pagar-expenses :expenses="$expenses"/>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/print.min.js') }}"></script>
@endsection
