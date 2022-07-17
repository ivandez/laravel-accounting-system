@extends('base')

@section('content')
    <div class="container">

        <div class="row mt-3">
            <div class="col">
                <h3>Proveedores</h3>
            </div>
        </div>

        @if (session('success'))
            <div class="row my-3">
                <div class="col">
                    <x-alert variant="alert-success" message="{{ session('success') }}"/>
                </div>
            </div>
        @endif


        <div class="row my-3">
            <div class="col">

                <form action="{{ route('providers.query') }}" method="get">
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

                <a href="{{ route('providers.create') }}" type="button" class="btn btn-success">Agregar nuevo proveedor</a>
                @endif
            </div>
        </div>

        @if (count($providers) > 0)
        <div class="row mt-3">
            <div class="col">
                <button type="button" class="btn btn-primary" onclick="printJS({printable: 'providers-table', type: 'html', ignoreElements: ['opciones']})">
                    Impresión rapida
                </button>
        </div>
    @endif

        <div class="row mt-3">
            <div class="col">
                <x-providers-table :providers="$providers"/>
            </div>
        </div>

        <div class="row text-center">
            <div class="col">
                {{ $providers->links() }}
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/print.min.js') }}"></script>
@endsection
