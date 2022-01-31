@extends('base')

@section('content')

    <div id="app">
        <expense-create></expense-create>
    </div>

@endsection

@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
