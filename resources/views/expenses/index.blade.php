@extends('base')

@section('content')

    <div class="container">

        <div class="row mt-3">
            <div class="col">
                <h3>Gastos</h3>
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
                <x-search-bar url="{{ route('expense.query') }}"/>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                @if(auth()->user()->rol == 1)
                    <a href="{{ route('expense.create') }}" type="button" class="btn btn-success">Agregar nuevo gasto</a>
                @endif
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <x-expense-table :expenses="$expenses"/>
            </div>
        </div>

    </div>

@endsection
