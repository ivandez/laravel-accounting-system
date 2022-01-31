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

<div class="container vh-100">

    <div class="row h-100 justify-content-center align-items-center">

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

            @if (session('status'))
                <div class="alert alert-success mt-3">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="post">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                </div>

                <div class="mb-3">
                    <a href="{{ route('login') }}">Iniciar sesión</a>
                </div>
                <button type="submit" class="btn btn-primary">Recuperar contraseña</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
