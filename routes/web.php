<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\BussinesController;
use \App\Http\Controllers\StatisticController;
use \App\Http\Controllers\ReportController;
use \App\Http\Controllers\HelpController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/', fn () => redirect()->route('sales.index'));

    Route::get('home', fn () => redirect()->route('sales.index'));

    // SALES
    Route::prefix('ventas')->group(function () {
        Route::get('/', [SaleController::class, 'index'])->name('sales.index');
        Route::get('/preparar-venta', [SaleController::class, 'prepararVenta'])->name('sales.prepararVenta');
        Route::get('/venta-con-nuevo-cliente', [SaleController::class, 'createWithNewClient'])->name('sales.create-with-new-client');
        Route::post('/store', [SaleController::class, 'store'])->name('sales.store');
        Route::get('/ver/{sale}', [SaleController::class, 'show'])->name('sales.show');
        Route::put('/update/{sale}', [SaleController::class, 'update'])->name('sales.update');
        Route::post('/delete/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');
        Route::get('/buscar', [SaleController::class, 'query'])->name('sales.query');
        Route::get('/crear', [SaleController::class, 'create'])->name('sales.create');
        Route::get('/por-cobrar', [SaleController::class, 'toPay'])->name('sales.toPay');
        Route::get('/buscar-por-pagar', [SaleController::class, 'queryToPay'])->name('sales.queryToPay');
        Route::get('/invoce/{sale}', [SaleController::class, 'getInvoice'])->name('sales.getInvoice');
        Route::put('/update-status/{sale}', [SaleController::class, 'updateStatus'])->name('sales.updateStatus');
    });

    // EXPENSES
    Route::prefix('gastos')->group(function () {
        Route::get('/', [ExpenseController::class, 'index'])->name('expense.index');
        Route::post('/store', [ExpenseController::class, 'store'])->name('expense.store');
        Route::get('/ver/{expense}', [ExpenseController::class, 'show'])->name('expense.show');
        Route::put('/update/{expense}', [ExpenseController::class, 'update'])->name('expense.update');
        Route::post('/delete/{expense}', [ExpenseController::class, 'destroy'])->name('expense.destroy');
        Route::get('/buscar', [ExpenseController::class, 'query'])->name('expense.query');
        Route::get('/crear', [ExpenseController::class, 'create'])->name('expense.create');
        Route::get('/por-pagar', [ExpenseController::class, 'porPagar'])->name('expense.porPagar');
        Route::put('/update-status/{expense}', [ExpenseController::class, 'updateStatus'])->name('expense.updateStatus');
    });

    // CLIENTS
    Route::prefix('clientes')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('clients.index');
        Route::get('/agregar', [ClientController::class, 'create'])->name('clients.create');
        Route::post('/store', [ClientController::class, 'store'])->name('clients.store');
        Route::get('/editar/{client}', [ClientController::class, 'edit'])->name('clients.edit');
        Route::put('/update/{client}', [ClientController::class, 'update'])->name('clients.update');
        Route::post('/delete/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
        Route::get('/buscar', [ClientController::class, 'query'])->name('clients.query');
    });

    // PROVIDERS
    Route::prefix('proveedores')->group(function () {
        Route::get('/', [ProviderController::class, 'index'])->name('providers.index');
        Route::get('/agregar', [ProviderController::class, 'create'])->name('providers.create');
        Route::post('/store', [ProviderController::class, 'store'])->name('providers.store');
        Route::get('/editar/{provider}', [ProviderController::class, 'edit'])->name('providers.edit');
        Route::put('/update/{provider}', [ProviderController::class, 'update'])->name('providers.update');
        Route::post('/delete/{provider}', [ProviderController::class, 'destroy'])->name('providers.destroy');
        Route::get('/buscar', [ProviderController::class, 'query'])->name('providers.query');
    });

    // PRODUCTS
    Route::prefix('productos')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/agregar', [ProductController::class, 'create'])->name('products.create');
        Route::post('/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/editar/{product}', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/update/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::post('/delete/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/buscar', [ProductController::class, 'query'])->name('products.query');
    });

    // Users
    Route::resource('/usuarios', UserController::class);

    // Bussines
    Route::resource('/empresa', BussinesController::class);

    // Statitics
    Route::get('/estadisticas', [StatisticController::class, 'index'])->name('statistic.index');

    // Report
    Route::get('/reporte', [ReportController::class, 'index'])->name('report.index');
    Route::get('/reporte-sales', [ReportController::class, 'getReportSalesView'])->name('report.getReportSalesView');
    Route::post('/reporte-sales', [ReportController::class, 'getReportSales'])->name('report.getReportSales');
    Route::get('/reporte-sales-test', [ReportController::class, 'getProductosViewVue']);

    Route::get('/reporte-deudas-por-cobrar', [ReportController::class, 'getReportSalesPorCobrarView'])->name('report.getReportSalesPorCobrarView');
    Route::post('/reporte-deudas-por-cobrar', [ReportController::class, 'getReportSalesPorCobrar'])->name('report.getReportSalesPorCobrar');

    Route::get('/reporte-expense', [ReportController::class, 'getReportExpenseView'])->name('report.getReportExpenseView');
    Route::post('/reporte-expense', [ReportController::class, 'getReportExpense'])->name('report.getReportExpense');

    Route::get('/reporte-deudas-por-pagar', [ReportController::class, 'getReportExpensePorPagarView'])->name('report.getReportExpensePorPagarView');
    Route::post('/reporte-deudas-por-pagar', [ReportController::class, 'getReportExpensePorPagar'])->name('report.getReportExpensePorCobrar');

    Route::get('/reporte-productos', [ReportController::class, 'getProductosView'])->name('report.getProductosView');
    Route::post('/reporte-productos', [ReportController::class, 'getProductos'])->name('report.getProductos');

    Route::get('/soporte', HelpController::class)->name('soporte');
});



// TODO tests controllers delete this
Route::get('ventas-totales', [\App\Http\Controllers\TestController::class, 'getTotalSales']);
Route::get('gastos-totales', [\App\Http\Controllers\TestController::class, 'getTotalExpenses']);
Route::get('utilidad', [\App\Http\Controllers\TestController::class, 'utilidad']);
Route::get('invoice', [\App\Http\Controllers\TestController::class, 'invoice']);
Route::get('deudas-por-pagar', [\App\Http\Controllers\TestController::class, 'deudasPortPagar']);
Route::get('deudas-por-cobrar', [\App\Http\Controllers\TestController::class, 'getDeudasPorCobrar']);
Route::get('clientes-mas', [\App\Http\Controllers\TestController::class, 'clienteMas']);
Route::get('print-demo', function () {
    return view('printdemo');
});

Route::get('navbar-test', function () {
    return view('base');
});
