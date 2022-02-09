<?php

namespace App\Services;

use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;

class InvoceService
{

    public function getInvoice($sale){

//        return $sale->client;

        if($sale->client){
            $customer = new Buyer([
                'name'          => $sale->client->first_name . ' ' . $sale->client->last_name,
                'custom_fields' => [
                    'número de teléfono' => $sale->client->phone_number,
                    'Cédula/Rif' => $sale->client->documentType->type . $sale->client->document,
                ],
            ]);
        }else{
            $customer = new Buyer(['name' => 'No aplica']);
        }


        $items = [];

        foreach ($sale->products as $product) {
            $items[] = (new InvoiceItem())->title($product->name)->pricePerUnit($product->pivot->product_price)->quantity($product->pivot->quantity);
        }

        $notes = [
            $sale?->comment
        ];

        $notes = implode("<br>", $notes);

        $invoice = Invoice::make()
            ->series('V')
            ->sequence(str_replace ('V', '', $sale->serial_number))
            ->serialNumberFormat('{SERIES}-{SEQUENCE}')
            ->buyer($customer)
            ->dateFormat('d/m/Y')
            ->notes($notes)
            ->addItems($items);

        return $invoice->stream();
    }
}
