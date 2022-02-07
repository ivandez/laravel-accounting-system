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

                <form action="{{ route('usuarios.update', $usuario) }}" method="post">
                    @csrf @method('PUT')

                    <div class="form-group mb-3">
                        <label for="exampleInputName">Nombre</label>
                        <input value="{{ $usuario->name }}" required type="text" class="form-control"
                               id="exampleInputName" aria-describedby="nameHelp" name="name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="apellidos">Email:</label>
                        <input value="{{ $usuario->email }}" required type="text" class="form-control" id="apellidos"
                               aria-describedby="nameHelp" name="email">
                    </div>

                    {{--                    Entra a este if si es administrador--}}
                    @if($usuario->rol)
{{--                        si el usuario es el admin maestro no se puede actualizar--}}
                        @if($usuario->id == 1)
                        @else
                            <div class="form-group mb-3">
                                <label for="exampleInputPhoneNumber">Rol:</label>
                                <select class="form-select" name="rol" required>
                                    @if($usuario->rol)
                                        <option selected value="1">admin</option>
                                        <option value="0">empleado</option>
                                    @else
                                        <option value="1">admin</option>
                                        <option selected value="0">empleado</option>
                                    @endif
                                </select>
                            </div>
                        @endif
                    @else
                    @endif


                    <button type="submit" class="btn btn-success">Actualizar usuario</button>
                    <a href="{{ route('usuarios.store') }}" type="button" class="btn btn-danger">Volver atrás</a>
                </form>

            </div>
        </div>
    </div>

@endsection
