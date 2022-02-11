<?php

namespace App\Http\Controllers;

use App\Services\GetBalanceService;


use Illuminate\Support\Facades\DB;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Rap2hpoutre\FastExcel\FastExcel;

class TestController extends Controller
{

    private GetBalanceService $getBalanceService;

    public function __construct(GetBalanceService $getBalanceService)
    {
        $this->getBalanceService = $getBalanceService;
    }

    public function getGanaciasTotales(){
        return $this->getBalanceService->getTotalEarnings();
    }

    public function getTotalExpenses(){
        return $this->getBalanceService->getTotalExpenses();
    }

    public function utilidad(){
        return $this->getBalanceService->getTotalUtility();
    }

    public function invoice(){
        $customer = new Buyer([
            'name'          => 'John Doe',
            'custom_fields' => [
                'email' => 'test@example.com',
            ],
        ]);

        $items = [
            (new InvoiceItem())->title('Service 1')->pricePerUnit(2),
            (new InvoiceItem())->title('Service 2')->pricePerUnit(2)->quantity(20)
        ];

        $notes = [
            'your multiline',
            'additional notes',
            'in regards of delivery or something else',
        ];

        $notes = implode("<br>", $notes);

        $invoice = Invoice::make()
            ->series('V')
            ->sequence(667)
            ->serialNumberFormat('{SERIES}-{SEQUENCE}')
            ->buyer($customer)
            ->dateFormat('d/m/Y')
            ->notes($notes)
            ->addItems($items);

        return $invoice->stream();
    }

    public function reporte(){
        $asd =DB::table('sales')
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
            ->whereBetween('sales.date', ['2022-02-11', '2022-02-16'])
            ->get();

        return (new FastExcel($asd))->download('file.xlsx');;
    }
}
