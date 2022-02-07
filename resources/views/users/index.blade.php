@extends('base')

@section('content')

    <div class="container">

        <div class="row mt-3">
            <div class="col">
                <h3>Panel de usuarios</h3>
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
                <a href="{{ route('usuarios.create') }}" type="button" class="btn btn-success">Agregar nuevo usuario</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th>{{$user->name}}</th>
                            <th>{{$user->email}}</th>
                            @if($user->rol)
                                <th>admin</th>
                            @else
                                <th>empleado</th>
                            @endif
                            @if(auth()->user()->rol == 1)
                                @if($user->id == 1)
                                    <td>
                                        <a href="{{ route('usuarios.show', $user->id) }}" type="button"
                                           class="btn btn-primary">Ver</a>
                                    </td>
                                @else
                                    <td>
                                        <a href="a" type="button"
                                           class="btn btn-primary">Ver</a>
                                        <form action="{{route('usuarios.destroy', $user)}}" class="d-inline" method="post">
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                @endif
                            @else
                                <td>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="row text-center">
            <div class="col">
                {{ $users->links() }}
            </div>
        </div>

    </div>
{{--// TODO si el usuario es admin que no pueda modificar el usuario principal ni pueda eliminar su propia cuenta--}}
@endsection
