@extends('base')

@section('content')
<div id="app">
    <report-products></report-products>
</div>

@endsection

@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
