<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

{{--    BOOTSTRAP 5     --}}
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>
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
                    <a class="nav-link" aria-current="page" href="{{ route('sales.index') }}">Balance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('expense.index') }}">Gastos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Deudas
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('sales.toPay') }}">Por cobrar</a></li>
                        <li><a class="dropdown-item" href="{{ route('expense.porPagar') }}">Por pagar</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('products.index') }}">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('clients.index')}}">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('providers.index') }}">Proveedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('usuarios.index')}}">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('empresa.index')}}">Empresa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('statistic.index') }}">Estadísticas</a>
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
