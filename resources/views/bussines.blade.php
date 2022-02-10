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

                <form action="{{ route('empresa.update', $empresa) }}" method="post">
                    @csrf @method('PUT')

                    <div class="form-group mb-3">
                        <label for="exampleInputName">Nombre de la empresa</label>
                        <input required value="{{$empresa->name}}" type="text" class="form-control" id="exampleInputName" aria-describedby="nameHelp" name="name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="apellidos">Dirrección:</label>
                        <input value="{{$empresa->address}}" required type="text" class="form-control" id="apellidos" aria-describedby="nameHelp" name="address">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Rif:</label>
                        <input value="{{$empresa->rif}}"  required type="number" placeholder="Ejemplo: 999999" class="form-control" name="rif" id="costo_unitario">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Número de contacto 1:</label>
                        <input value="{{$empresa->phone_number1}}" type="text" min="1" class="form-control" name="phone_number1" id="costo_unitario">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Número de contacto 2 (opcional):</label>
                        <input value="{{$empresa->phone_number2}}"  type="text" class="form-control" name="phone_number2" id="costo_unitario">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Email (opcional):</label>
                        <input value="{{$empresa->email}}"  type="email" class="form-control" name="email" id="costo_unitario">
                    </div>

                    <button type="submit" class="btn btn-success">Actualizar datos</button>
                    <a href="{{ url()->previous() }}" type="button" class="btn btn-danger">Volver atrás</a>
                </form>

            </div>
        </div>
    </div>

@endsection
