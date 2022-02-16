<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

{{--    BOOTSTRAP 5     --}}
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <title>{{ env('APP_NAME') }}</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">{{ env('APP_NAME') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    @if(url()->current() == 'http://localhost/ventas')
                        <a class="nav-link active border border-dark rounded-pill" aria-current="page" href="{{ route('sales.index') }}">Balance</a>
                    @else
                        <a class="nav-link" aria-current="page" href="{{ route('sales.index') }}">Balance</a>
                    @endif
                </li>
                <li class="nav-item">
                    @if(url()->current() == 'http://localhost/gastos')
                        <a class="nav-link active border border-dark rounded-pill" aria-current="page" href="{{ route('expense.index') }}">Gastos</a>
                    @else
                        <a class="nav-link" aria-current="page" href="{{ route('expense.index') }}">Gastos</a>
                    @endif
                </li>
                <li class="nav-item dropdown">
                    @if(url()->current() == 'http://localhost/ventas/por-cobrar' || url()->current() == 'http://localhost/gastos/por-pagar')
                        <a class="nav-link active border border-dark rounded-pill" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Deudas
                        </a>
                    @else
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Deudas
                        </a>
                    @endif
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('sales.toPay') }}">Por cobrar</a></li>
                        <li><a class="dropdown-item" href="{{ route('expense.porPagar') }}">Por pagar</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    @if(url()->current() == 'http://localhost/productos')
                        <a class="nav-link active border border-dark rounded-pill" aria-current="page" href="{{ route('products.index') }}">Productos</a>
                    @else
                        <a class="nav-link" aria-current="page" href="{{ route('products.index') }}">Productos</a>
                    @endif
                </li>
                <li class="nav-item">
                    @if(url()->current() == 'http://localhost/clientes')
                        <a class="nav-link active border border-dark rounded-pill" aria-current="page" href="{{route('clients.index')}}">Clientes</a>
                    @else
                        <a class="nav-link" aria-current="page" href="{{route('clients.index')}}">Clientes</a>
                    @endif
                </li>
                <li class="nav-item">
                    @if(url()->current() == 'http://localhost/proveedores')
                        <a class="nav-link active border border-dark rounded-pill" aria-current="page" href="{{ route('providers.index') }}">Proveedores</a>
                    @else
                        <a class="nav-link" aria-current="page" href="{{ route('providers.index') }}">Proveedores</a>
                    @endif
                </li>
                <li class="nav-item">
                    @if(url()->current() == 'http://localhost/usuarios')
                        <a class="nav-link active border border-dark rounded-pill" aria-current="page" href="{{route('usuarios.index')}}">Usuarios</a>
                    @else
                        <a class="nav-link" aria-current="page" href="{{route('usuarios.index')}}">Usuarios</a>
                    @endif
                </li>
                @if(auth()->user()->rol == 1)

                <li class="nav-item">
                    @if(url()->current() == 'http://localhost/empresa')
                        <a class="nav-link active border border-dark rounded-pill" aria-current="page" href="{{route('empresa.index')}}">Empresa</a>
                    @else
                        <a class="nav-link" aria-current="page" href="{{route('empresa.index')}}">Empresa</a>
                    @endif
                </li>
                @endif
                <li class="nav-item">
                    @if(url()->current() == 'http://localhost/estadisticas')
                        <a class="nav-link active border border-dark rounded-pill" aria-current="page" href="{{ route('statistic.index') }}">Estadísticas</a>
                    @else
                        <a class="nav-link" aria-current="page" href="{{ route('statistic.index') }}">Estadísticas</a>
                    @endif
                </li>
            </ul>
            <div class="d-flex">
                <form action="{{ route('logout') }}" method="post">
                    <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
</nav>

    @yield('content')

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @yield('scripts')

</body>
</html>

