<?php

namespace App\Http\Controllers;

use App\Services\GetBalanceService;


use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

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
}
