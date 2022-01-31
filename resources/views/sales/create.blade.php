@extends('base')

@section('content')

    <div id="app">
        <add-products></add-products>
    </div>

@endsection

@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
