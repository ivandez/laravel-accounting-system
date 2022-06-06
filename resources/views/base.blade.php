<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{--    BOOTSTRAP 5     --}}
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <style>
        #sidebar-container {
            background: #1f1d2d;
        }

        .sidebar__anchor:hover {
            background: #494b74;;
        }

    </style>
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>

<div class="d-flex">
    <div id="sidebar-container" class="p-2">
        <div>
            <h4 class="text-light fw-bold">{{ env('APP_NAME') }}</h4>
        </div>
        <div id="menu" class="text-white text-capitalize">
            <a href={{ route('sales.index') }} class="d-block p-3 nav-link text-white sidebar__anchor"><img
                    src={{ asset('icons/dollar.png') }} width="25px"> Balance</a>
            <a href={{ route('expense.index') }} class="d-block p-3 nav-link text-white sidebar__anchor"><img
                    src={{ asset('icons/expense.png') }} width="25px"> Gastos</a>
            <a href={{ route('sales.toPay')}} class="d-block p-3 nav-link text-white sidebar__anchor"><img
                    src={{ asset('icons/debt.png') }} width="25px"> deudas por cobrar</a>
            <a href={{ route('expense.porPagar')}} class="d-block p-3 nav-link text-white sidebar__anchor"><img
                    src={{ asset('icons/borrow.png') }} width="25px"> deudas por pagar</a>
            <a href={{ route('products.index')}} class="d-block p-3 nav-link text-white sidebar__anchor"><img
                    src={{ asset('icons/product.png') }} width="25px"> productos</a>
            <a href={{ route('clients.index') }} class="d-block p-3 nav-link text-white sidebar__anchor"><img
                    src={{ asset('icons/clients.png') }} width="25px"> clientes</a>
            <a href={{route('providers.index')}} class="d-block p-3 nav-link text-white sidebar__anchor"><img
                    src={{ asset('icons/providers.png') }} width="25px"> proveedores</a>
            <a href={{route('usuarios.index')}} class="d-block p-3 nav-link text-white sidebar__anchor"><img
                    src={{ asset('icons/user.png') }} width="25px"> usuarios</a>
            <a href={{ route('empresa.index') }} class="d-block p-3 nav-link text-white sidebar__anchor"><img
                    src={{ asset('icons/company.png') }} width="25px"> empresa</a>
            <a href={{ route('statistic.index') }} class="d-block p-3 nav-link text-white sidebar__anchor"><img
                    src={{ asset('icons/statistics.png') }} width="25px"> estadísticas</a>
        </div>
    </div>
    <div class="w-100">
        {{--       THIS IS THE  Navbar--}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ $section }}</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        </li>
                    </ul>
                    <form action="{{ route('logout') }}" method="post" class="d-flex">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">Bienvenido {{ Auth()->user()->name }}</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li class="dropdown-item"><button type="submit" class="btn btn-danger">Cerrar sesión</button></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        <div id="content">
            <section>
                @yield('content')
            </section>
        </div>
    </div>
</div>


<script src="{{ asset('js/bootstrap.min.js') }}"></script>

@yield('scripts')

</body>
</html>

