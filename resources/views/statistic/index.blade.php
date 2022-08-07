@extends('base')

@section('content')

    <div class="container">

        <div class="row my-3 justify-content-center align-items-center">
            <div class="col">
                <canvas id="ventasYgastos"></canvas>
            </div>
        </div>



    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>
<script>
    // const labels = Utils.months({count: 7});
    const data = {
        labels: [1,2,3,4,5,6,7],
        datasets: [
            {
            label: 'Ventas',
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: false,
            borderColor: '#97CC04',
            tension: 0.1
        },
            {
            label: 'Gastos',
            data: [60,40,100,200,300,50,20],
            fill: false,
            borderColor: '#F04104',
            tension: 0.1
        },
    ]
    };
    const config = {
        type: 'line',
        data: data,
    };

    const myChart = new Chart(
    document.getElementById('ventasYgastos'),
    config
  );
</script>
@endsection
