@extends('base')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col">
                <x-most-seller-products :products="$products"/>
            </div>
        </div>

    </div>
    <canvas id="myChart" width="400" height="400"></canvas>
@endsection

@section('scripts')
    <script>
        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: [1,2,3],
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Doughnut Chart'
                    }
                }
            },
        });
    </script>
@endsection
