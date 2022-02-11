@extends('base')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col">
                <x-most-seller-products :products="$products"/>
            </div>
        </div>

    </div>

@endsection
