@extends('base')

@section('content')

    <div class="container">

        <div class="row my-3">
            <div class="col">
                <canvas id="ventasYgastos"></canvas>
            </div>
        </div>

        <div class="row my-3">
            <div class="col">
                <canvas id="deudasPorCobrar"></canvas>
            </div>
            <div class="col">
                <canvas id="deudasPorPagar"></canvas>
            </div>
        </div>

        <div class="row my-3">
            <div class="col">
                <canvas id="productosConMasVentas"></canvas>
            </div>
        </div>



    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>
<script>
    const data = {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
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
<script>

    const dataPiePorPagar = {
        labels: [
            'Red',
            'Blue',
            'Yellow'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    const configPiePorPagar = {
        type: 'pie',
        data: dataPiePorPagar,
    };

    const myChartPiePorPagar = new Chart(
    document.getElementById('deudasPorPagar'),
    configPiePorPagar
  );

  axios.get("http://localhost/api/tests").then(res => console.log(res));
</script>
<script>
    const dataPie = {
        labels: [
            'Red',
            'Blue',
            'Yellow'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    const configPie = {
        type: 'pie',
        data: dataPie,
    };

    const myChartPie = new Chart(
    document.getElementById('deudasPorCobrar'),
    configPie
  );
</script>
<script>
    const dataBar = {
  labels: [1,2,3,4,5,6,7],
  datasets: [{
    label: 'My First Dataset',
    data: [65, 59, 80, 81, 56, 55, 40],
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};

    const configBar = {
        type: 'bar',
        data: dataBar,
        options: {
            scales: {
            y: {
                beginAtZero: true
                }
            }
        },
    };

    const myChartBar = new Chart(
    document.getElementById('productosConMasVentas'),
    configBar
  );
</script>
@endsection
