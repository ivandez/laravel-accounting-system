@extends('base')

@section('content')

    <div class="container">

        <div class="row mt-3">
            <div class="col">
                <a href="{{ route('sales.create-with-new-client') }}" type="button" class="btn btn-primary">Venta nuevo cliente</a>
            </div>
            @if ($clients > 0)
            <div class="col">
                <a href="{{ route('sales.create') }}" type="button" class="btn btn-success">Venta con cliente ya registrado</a>
            </div>
            @endif
        </div>



    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/print.min.js') }}"></script>
@endsection
