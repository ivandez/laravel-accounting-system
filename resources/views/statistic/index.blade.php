@extends('base')

@section('content')

    <div class="container">

        <div class="row my-3">
            <div class="col">
                <canvas id="ventasYgastos"></canvas>
            </div>
        </div>

        <div class="row my-3">
            <div class="col text-center">
                <h2>Deudas por cobrar</h2>
                <canvas id="deudasPorCobrar"></canvas>
            </div>

            <div class="col text-center">
                <h2>Deudas por pagar</h2>
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

const buildGropu = (months) => {

let grupos = []

months.forEach(item => {
    grupos.push({month: item, data:  []})
} )

return grupos
}

    const orderByMonth = (arr) => {
        let months = []

        arr.forEach(item => {
            const month = item.date.split('-')

            const monthExists = months.find(m => m === month[1])

            if(!monthExists){

                months.push(month[1])
            }
        } )
       return buildGropu(months)
    }


    const deleteRepeteatCode = (arr) => {
        let newArr = []
        arr.forEach(item => {
            const codeExists = newArr.find(m => m.serial_number === item.serial_number)

            if(!codeExists){
                newArr.push(item)
            }
        } )
        return newArr
    }

    const gropuByMonth = (arr, months) => {

        const filterArr =   deleteRepeteatCode(arr)
        filterArr.forEach(item => {

            const month = item.date.split('-')

            const mIndex = months.findIndex((m) => m.month === month[1])

            months[mIndex].data.push(item)

        } )
       return months
    }

    const fetchVentasAgno = async () => {
        const {data} = await axios.get('/api/ventas-del-agno');
        const months = orderByMonth(data)
        gropuByMonth(data, months)
        console.log("🚀 ~ file: index.blade.php ~ line 82 ~ fetchVentasAgno ~ gropuByMonth(data, months)", gropuByMonth(data, months))
    }
    fetchVentasAgno()
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

const fetchDataPorPagar = async () => {
    const {data} = await axios.get('http://localhost/api/deudas-por-pagar');
    console.log("🚀 ~ file: index.blade.php ~ line 71 ~ fetchData ~ data", data)
    const dataPiePorPagar = {
        labels: [
            'Deudas por Pagar',
            'Deudas Pagadas'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [data.toPay, data.isPaid],
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
}
fetchDataPorPagar()
</script>
<script>

const fetchData = async () => {
    const {data} = await axios.get("http://localhost/api/deudas-por-cobrar")

    const dataPie = {
        labels: [
            'Deudas por cobrar',
            'Deudas pagadas',
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [data.toPay, data.isPaid],
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
}

fetchData()

</script>
<script>

const sumSales = (sales) => {
    const totalSales = []


    const entries = Object.entries(sales).map(item => {
        return item
    })

    entries.forEach(item => {

        const quantity = item[1].reduce((acc, curr) => {
            return acc + curr
        } , 0)


        const newSale = {
            name: item[0],
            quantity: quantity
        }
        totalSales.push(newSale)
    } )

    return totalSales

}
const fetchDataProductosMasVendidos= async () => {
    const {data} = await axios.get("http://localhost/api/productos-mas-vendidos")

    console.log("🚀 ~ file: index.blade.php ~ line 153 ~ fetchDataProductosMasVendidos ~ data", data)

    const sales = sumSales(data)
    console.log("🚀 ~ file: index.blade.php ~ line 171 ~ fetchDataProductosMasVendidos ~ sales", sales)

    const dataBar = {
  labels: [sales[0].name, sales[1].name, sales[2].name, sales[3].name],
  datasets: [{
    label: 'Productos más vendidos',
    data: [sales[0].quantity, sales[1].quantity, sales[2].quantity, sales[3].quantity],
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
}
fetchDataProductosMasVendidos()

</script>
@endsection
