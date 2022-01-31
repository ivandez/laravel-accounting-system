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

                <form action="{{ route('providers.update', $provider) }}" method="post">
                    @method('PUT')
                    @csrf

                    <div class="form-group mb-3">
                        <label for="exampleInputName">Nombres</label>
                        <input required type="text" class="form-control" id="exampleInputName"
                               value="{{ $provider->first_name }}" name="nombres">
                    </div>

                    <div class="form-group mb-3">
                        <label for="apellidos">Apellidos (opcional):</label>
                        <input type="text" class="form-control" id="apellidos" value="{{ $provider->last_name }}"
                               name="apellidos">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputPhoneNumber">Número de teléfono (opcional)</label>
                        <input type="text" class="form-control" id="exampleInputPhoneNumber" name="telefono"
                               value="{{ $provider->phone_number }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="apellidos">Documento (opcional):</label>
                        <div class="row">
                            <div class="col">
                                <select class="form-select" aria-label="Default select example"
                                        name="tipo_de_documento">

                                    @if(!is_null($provider->documentType?->id))
{{--                                        ENTER HERE IF MODEL HAS DOCUMENT--}}
                                        @foreach($documentsTypes as $documentType)
                                            @if($documentType->id == $provider->documentType->id)
                                                <option selected
                                                        value="{{ $documentType->id }}"> {{ $documentType->type }}</option>
                                            @else
                                                <option
                                                    value="{{ $documentType->id }}"> {{ $documentType->type }}</option>
                                            @endif

                                        @endforeach
{{--                                        ENTER HERE IF MODEL DOES NOT HAVE DOCUMENT--}}
                                    @else
                                        @foreach($documentsTypes as $documentType)
                                            <option value="{{ $documentType->id }}"> {{ $documentType->type }}</option>

                                        @endforeach
                                    @endif

                                </select>
                            </div>
                            <div class="col">
                                <input type="number" min="1" class="form-control" placeholder="Ejemplo: 999999999"
                                       name="documento" id="documento" value="{{ $provider->document }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Comentario (opcional):</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                  name="comentario">{{ $provider->comment }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar proveedor</button>
                    <a href="{{ route('providers.index') }}" type="button" class="btn btn-danger">Volver atrás</a>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        const documentoInput = document.getElementById('documento')

        documentoInput.addEventListener('keydown', (e) => {
            let tecla = e.key;

            if ([".", "e", "-"].includes(tecla)) e.preventDefault();
        })

    </script>
@endsection
