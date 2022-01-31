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

                <form action="{{ route('products.update', $product) }}" method="post">
                    @csrf @method('PUT')

                    <div class="form-group mb-3">
                        <label for="exampleInputName">Nombre</label>
                        <input value="{{ $product->name }}" required type="text" class="form-control" id="exampleInputName" aria-describedby="nameHelp" name="nombre">
                    </div>

                    <div class="form-group mb-3">
                        <label for="apellidos">Descripción (opcional):</label>
                        <input value="{{ $product->description }}" type="text" class="form-control" id="apellidos" aria-describedby="nameHelp" name="descripcion">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Costo unitario:</label>
                        <input value="{{ $product->cost_price }}" type="number" min="1" class="form-control" name="costo_unitario" id="costo_unitario">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Costo de venta:</label>
                        <input value="{{ $product->unit_price }}" type="number" min="1" class="form-control" name="costo_de_venta" id="costo_de_venta">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Cantidad (stock):</label>
                        <input value="{{ $product->quantity }}" type="number" min="1" class="form-control" name="cantidad" id="cantidad">
                    </div>

                    <button type="submit" class="btn btn-success">Actualizar producto</button>
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
