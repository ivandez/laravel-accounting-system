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

                <form action="{{ route('products.store') }}" method="post">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="exampleInputName">Nombre</label>
                        <input required type="text" class="form-control" id="exampleInputName" aria-describedby="nameHelp" name="nombre">
                    </div>

                    <div class="form-group mb-3">
                        <label for="apellidos">Descripción (opcional):</label>
                        <input type="text" class="form-control" id="apellidos" aria-describedby="nameHelp" name="descripcion">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Precio unitario (precio de venta):</label>
                        <input type="number" min="1" class="form-control" name="precio_unitario" id="costo_unitario">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Costo unitario (precio de compra):</label>
                        <input type="number" min="1" class="form-control" name="costo_unitario" id="costo_de_venta">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Cantidad (stock):</label>
                        <input type="number" min="1" class="form-control" name="cantidad" id="cantidad">
                    </div>

                    <button type="submit" class="btn btn-success">Crear producto</button>
                    <a href="{{ route('products.index') }}" type="button" class="btn btn-danger">Volver atrás</a>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        const documentoInput = document.getElementById('documento')

        documentoInput.addEventListener('keydown', (e) =>{
            let tecla = e.key;

            if ([".", "e", "-"].includes(tecla)) e.preventDefault();
        })

    </script>
@endsection
