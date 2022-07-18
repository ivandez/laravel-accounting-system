@extends('base')

@section('content')
    <div class="container">

        @if (session('success'))
            <div class="row my-3">
                <div class="col">
                    <x-alert variant="alert-success" message="{{ session('success') }}"/>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row mt-3">
            <div class="col">
                <h3>Reporte de productos creados</h3>
            </div>
        </div>
        <div class="row mt-3">

            <div class="col">
                <form action="{{ route('report.getProductos') }}" method="post">
                    @csrf @method('POST')
                    <div class="custom-control custom-radio">
                        <input required type="radio" id="customRadio1" value="1" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio1">Agregados de más nuevo a más viejo</label>
                      </div>
                      <div class="custom-control custom-radio mb-3">
                        <input required type="radio" id="customRadio2" value="0" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio2">Agregados de más viejo a más nuevo</label>
                      </div>

                    <button type="submit" class="btn btn-success">Obtener reporte</button>
                    <a href="{{ route('report.index') }}" type="button" class="btn btn-danger">Volver a reportes</a>
                </form>

            </div>
        </div>
    </div>

@endsection
