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

                <form action="{{ route('clients.store') }}" method="post">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="exampleInputName">Nombres</label>
                        <input type="text" class="form-control" id="exampleInputName" aria-describedby="nameHelp" name="nombres">
                    </div>

                    <div class="form-group mb-3">
                        <label for="apellidos">Apellidos (opcional):</label>
                        <input type="text" class="form-control" id="apellidos" aria-describedby="nameHelp" name="apellidos">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Número de teléfono</label>
                        <input type="text" class="form-control" id="exampleInputPhoneNumber" name="telefono">
                    </div>

                    <div class="form-group mb-3">
                        <label for="apellidos">Documento:</label>
                        <div class="row">
                            <div class="col">
                                <select class="form-select" aria-label="Default select example" name="tipo_de_documento">
                                    @foreach($documentsTypes as $documentType)
                                        <option value="{{ $documentType->id }}"> {{ $documentType->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <input type="number" min="1" class="form-control" placeholder="Ejemplo: 999999999" name="documento" id="documento">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Comentario (opcional):</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comentario"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Crear cliente</button>
                    <a href="{{ route('clients.index') }}" type="button" class="btn btn-danger">Volver atrás</a>
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
