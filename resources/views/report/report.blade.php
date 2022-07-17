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

        <div  class="row mt-3">
            <div class="col mt-3">
                <div class="card" style="width: 18rem;align-items: center;">
                    <img src="{{ asset('icons/dollar.png')}}" class="card-img-top w-50 mt-2" alt="...">
                    <div class="card-body">
                        <button type="button" class="btn btn-success">Reporte de ventas</button>
                    </div>
                  </div>
            </div>
            <div class="col mt-3">
                <div class="card" style="width: 18rem;align-items: center;">
                    <img src="{{ asset('icons/dollar.png')}}" class="card-img-top w-50 mt-2" alt="...">
                    <div class="card-body">
                        <button type="button" class="btn btn-success">Reporte de ventas</button>
                    </div>
                  </div>
            </div>
            <div class="col mt-3">
                <div class="card" style="width: 18rem;align-items: center;">
                    <img src="{{ asset('icons/dollar.png')}}" class="card-img-top w-50 mt-2" alt="...">
                    <div class="card-body">
                        <button type="button" class="btn btn-success">Reporte de ventas</button>
                    </div>
                  </div>
            </div>
            <div class="col mt-3">
                <div class="card" style="width: 18rem;align-items: center;">
                    <img src="{{ asset('icons/dollar.png')}}" class="card-img-top w-50 mt-2" alt="...">
                    <div class="card-body">
                        <button type="button" class="btn btn-success">Reporte de ventas</button>
                    </div>
                  </div>
            </div>
        </div>

        <div class="row mt-3">

            <div class="col">

                <form action="{{route('report.getReport')}}" method="post">
                    @csrf @method('POST')

                    <div class="form-group mb-3">
                        <label for="exampleInputName">Desde:</label>
                        <input required type="date" class="form-control" id="exampleInputName" aria-describedby="nameHelp" name="date">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputName">Hasta:</label>
                        <input required type="date" class="form-control" id="exampleInputName" aria-describedby="nameHelp" name="date2">
                    </div>

                    <button type="submit" class="btn btn-success">Obtener reporte</button>
                    <a href="{{ route('sales.index') }}" type="button" class="btn btn-danger">Volver atrás</a>
                </form>

            </div>
        </div>
    </div>

@endsection
