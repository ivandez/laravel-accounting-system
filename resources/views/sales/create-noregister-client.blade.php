@extends('base')

@section('content')

    <div id="app">
        <add-products-with-noregister-client></add-products-with-noregister-client>
    </div>

@endsection

@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
