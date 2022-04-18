<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{--    BOOTSTRAP 5     --}}
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>
    <style>
        body{
            background: #494b74;
        }
    </style>
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>

<div class="container vh-100">

    <div class="row h-100 justify-content-center align-items-center w-50" style="margin: 0 auto;">

        <div class="col p-4 rounded-3" style="background: #fafafa;">

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="post" class="text-center">

                <legend class="text-uppercase">Iniciar sesión</legend>

                <div class="mb-3">
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="correo electronico">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="contraseña">
                </div>
                <div class="mb-3">
                    <a href="{{ route('password.request') }}" class="text-secondary">Recuperar contraseña</a>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
