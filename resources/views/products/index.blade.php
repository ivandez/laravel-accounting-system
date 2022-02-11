@extends('base')

@section('content')
    <div class="container">

        <div class="row mt-3">
            <div class="col">
                <h3>Productos</h3>
            </div>
        </div>

        @if (session('success'))
            <div class="row my-3">
                <div class="col">
                    <x-alert variant="alert-success" message="{{ session('success') }}"/>
                </div>
            </div>
        @endif

        @if (session('fail'))
            <div class="row my-3">
                <div class="col">
                    <x-alert variant="alert-danger" message="{{ session('fail') }}"/>
                </div>
            </div>
        @endif

        <div class="row my-3 justify-content-center">
            <div class="col">

                <div class="card text-center" >
                    <div class="card-body">
                        <h5 class="card-title">Total de referencias</h5>
                        <p class="card-text">Productos: {{ $productsCount }}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="row my-3">
            <div class="col">

                <form action="{{ route('products.query') }}" method="get">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="parametro" value="{{ $parametro ?? null }}"
                                   placeholder="Buscador">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="row">
            <div class="col">
                @if(auth()->user()->rol == 1)

                <a href="{{ route('products.create') }}" type="button" class="btn btn-success">Agregar nuevo
                    producto</a>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-products-table :products="$products"/>
            </div>
        </div>

        <div class="row text-center">
            <div class="col">
                {{ $products->links() }}
            </div>
        </div>

    </div>
@endsection
