<?php

namespace App\Services;

use App\Models\Bussines;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;

class InvoceService
{

    public function getInvoice($sale){

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

        $bussines = Bussines::first();

            $client = new Party([
                'name'          => $bussines->name,
                'phone'         => $bussines->phone_number1,
                'custom_fields' => [
                    'Dirección'        => $bussines->address,
                    'Teléfono 2'        => $bussines->phone_number2,
                    'Rif' => $bussines->rif,
                    'Email' => $bussines->email,
                ],
            ]);


        $invoice = Invoice::make()
            ->series('V')
            ->sequence(str_replace ('V', '', $sale->serial_number))
            ->serialNumberFormat('{SERIES}-{SEQUENCE}')
            ->buyer($customer)
            ->seller($client)
            ->dateFormat('d/m/Y')
            ->notes($notes)
            ->addItems($items);

        return $invoice->stream();
    }
}
