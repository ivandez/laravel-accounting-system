@extends('base')

@section('content')

    <div class="container">

        <div  class="row mt-3">
            <div class="col mt-3">
                <div class="card" style="width: 18rem;align-items: center;">
                    <img src="{{ asset('icons/dollar.png')}}" class="card-img-top w-50 mt-2" alt="...">
                    <div class="card-body">
                        <a href="{{route('report.getReportSalesView')}}" type="button" class="btn btn-success">Reporte de ventas</a>
                    </div>
                  </div>
            </div>

            <div class="col mt-3">
                <div class="card" style="width: 18rem;align-items: center;">
                    <img src="{{ asset('icons/debt.png')}}" class="card-img-top w-50 mt-2" alt="...">
                    <div class="card-body">
                        <a href="{{route('report.getReportSalesPorCobrarView')}}" type="button" class="btn btn-success">Reporte de deudas por cobrar</a>
                    </div>
                  </div>
            </div>

            <div class="col mt-3">
                <div class="card" style="width: 18rem;align-items: center;">
                    <img src="{{ asset('icons/expense.png')}}" class="card-img-top w-50 mt-2" alt="...">
                    <div class="card-body">
                        <a href="{{route('report.getReportExpenseView')}}" type="button" class="btn btn-success">Reporte de gastos</a>
                    </div>
                  </div>
            </div>

            <div class="col mt-3">
                <div class="card" style="width: 18rem;align-items: center;">
                    <img src="{{ asset('icons/borrow.png')}}" class="card-img-top w-50 mt-2" alt="...">
                    <div class="card-body">
                        <a href="{{route('report.getReportExpensePorPagarView')}}" type="button" class="btn btn-success">Reporte de deudas por pagar</a>
                    </div>
                  </div>
            </div>

            <div class="col mt-3">
                <div class="card" style="width: 18rem;align-items: center;">
                    <img src="{{ asset('icons/product.png')}}" class="card-img-top w-50 mt-2" alt="...">
                    <div class="card-body">
                        <a href="{{route('report.getProductos')}}" type="button" class="btn btn-success">Reporte de productos</a>
                    </div>
                  </div>
            </div>

        </div>
    </div>

@endsection
