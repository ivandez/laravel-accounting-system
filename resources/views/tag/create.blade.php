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

            <form action="{{ route('tag.store') }}" method="post">
                @csrf

                <div class="form-group mb-3">
                    <label for="exampleInputName">Nombre</label>
                    <input required type="text" class="form-control" id="exampleInputName" aria-describedby="nameHelp" name="nombre">
                </div>

                <button type="submit" class="btn btn-success">Crear Tag</button>
                <a href="{{ route('tag.index') }}" type="button" class="btn btn-danger">Volver atrás</a>
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
