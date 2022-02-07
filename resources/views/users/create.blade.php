@extends('base')

@section('content')

    <div class="container">

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

                <form action="{{ route('usuarios.store') }}" method="post">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="exampleInputName">Nombre</label>
                        <input required type="text" class="form-control" id="exampleInputName" aria-describedby="nameHelp" name="nombre">
                    </div>

                    <div class="form-group mb-3">
                        <label for="apellidos">Email:</label>
                        <input required type="email" class="form-control" id="apellidos" aria-describedby="nameHelp" name="email">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Contraseña:</label>
                        <input required type="password" min="1" class="form-control" name="password" id="costo_unitario">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Confirmar contraseña:</label>
                        <input required type="password" min="1" class="form-control" name="password_confirmation" id="costo_de_venta">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Rol:</label>
                        <select class="form-select" name="rol" required>
                                <option value="1">admin</option>
                                <option selected value="0">empleado</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Crear usuario</button>
                    <a href="{{ route('usuarios.index') }}" type="button" class="btn btn-danger">Volver atrás</a>
                </form>

            </div>
        </div>
    </div>

@endsection
