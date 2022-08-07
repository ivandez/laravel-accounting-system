<?php

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('products', function () {
    $products = \App\Models\Product::where('quantity', '>', 0)->get();
    return response()->json($products);
});

Route::get('clients', function () {
    $clients = \App\Models\Client::all();

    return response()->json($clients);
});

Route::get('payment-methods', function () {
    $paymentMethods = \App\Models\PaymentMethod::all();

    return response()->json($paymentMethods);
});

Route::get('providers', function () {
    $providers = \App\Models\Provider::all();

    return response()->json($providers);
});

Route::get('tags', function () {
    $providers = \App\Models\Tag::all();

    return response()->json($providers);
});

Route::post('/sales/store', [\App\Http\Controllers\SaleController::class, 'store'])->name('sales.store');

Route::post('/sales/store-no-client', [\App\Http\Controllers\SaleController::class, 'storeNewClient'])->name('sales.store-no-client');

Route::post('/expenses/store', [\App\Http\Controllers\ExpenseController::class, 'store'])->name('expenses.store');

Route::post('/reporte-productos', [\App\Http\Controllers\ReportController::class, 'getProductos']);

// Estadisticas
Route::get('deudas-por-cobrar', function () {

    $sales = Sale::where('is_paid', false)->get()->count();

    $salesPagadas = Sale::where('is_paid', true)->get()->count();

    $response = ['toPay' => $sales, 'isPaid' => $salesPagadas];

    return response()->json($response);
});
