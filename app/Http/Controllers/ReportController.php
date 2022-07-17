<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class ReportController extends Controller
{
    public function index()
    {
        return view('report/report')->with('section', 'Reporte');
    }

    public function getReportSalesView()
    {
        return view('report/reportSales')->with('section', 'Reporte de ventas');
    }

    public function getReportSalesPorCobrarView()
    {
        return view('report/reportSalesPorPagar')->with('section', 'Reporte de ventas por cobrar');
    }

    public function getReportSalesPorCobrar(Request $request)
    {

        $asd = DB::table('sales')
            ->join('product_sale', 'sales.id', '=', 'product_sale.sale_id')
            ->join('payment_methods', 'sales.payment_method_id', '=', 'payment_methods.id')
            ->join('products', 'product_sale.product_id', '=', 'products.id')
            ->select(
                'sales.serial_number as serial_de_la_venta',
                'sales.date as fecha',
                'products.serial_number AS serial_producto',
                'products.name AS producto',
                'payment_methods.name AS metodo_pago',
                'product_sale.quantity as cantidad',
                'product_sale.product_price as producto_precio'
            )->selectRaw('product_sale.product_price * product_sale.quantity as total')
            ->where('sales.is_paid', false)
            ->whereBetween('sales.date', [$request->date, $request->date2])
            ->get();

        return (new FastExcel($asd))->download('reporte.xlsx');;
    }

    public function getReportSales(Request $request)
    {

        $asd = DB::table('sales')
            ->join('product_sale', 'sales.id', '=', 'product_sale.sale_id')
            ->join('payment_methods', 'sales.payment_method_id', '=', 'payment_methods.id')
            ->join('products', 'product_sale.product_id', '=', 'products.id')
            ->select(
                'sales.serial_number as serial_de_la_venta',
                'sales.date as fecha',
                'products.serial_number AS serial_producto',
                'products.name AS producto',
                'payment_methods.name AS metodo_pago',
                'product_sale.quantity as cantidad',
                'product_sale.product_price as producto_precio'
            )->selectRaw('product_sale.product_price * product_sale.quantity as total')
            ->where('sales.is_paid', true)
            ->whereBetween('sales.date', [$request->date, $request->date2])
            ->get();

        return (new FastExcel($asd))->download('reporte.xlsx');;
    }

    public function getReportExpenseView()
    {
        return view('report/reportExpenses')->with('section', 'Reporte de gastos');
    }

    public function getReportExpense(Request $request)
    {

        $asd = DB::table('expenses')
            ->join('payment_methods', 'expenses.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('providers', 'providers.id', '=', 'expenses.provider_id')
            ->select(
                'expenses.comment as comentario',
                'expenses.date as fecha',
                'expenses.amount AS monto',
                'providers.first_name AS nombre proveedor',
                'providers.last_name AS apellido proveedor',
                'payment_methods.name AS metodo_pago',
            )->where('expenses.is_paid', true)
            ->whereBetween('expenses.date', [$request->date, $request->date2])
            ->get();

        return (new FastExcel($asd))->download('reporte.xlsx');
    }
}
