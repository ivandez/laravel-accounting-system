<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Expense;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class GetBalanceService
{

    /**
     * Retonar las ganacias totales
     * @return float
     */
    public function getTotalEarnings()
    {
        return $productSale = DB::table('sales')
            ->join('product_sale', 'sales.id', '=', 'product_sale.sale_id')
            ->select('product_sale.quantity', 'product_sale.product_price', 'product_cost')
            ->where('sales.is_paid', true)
            ->get();

        return $result = $productSale->map(function ($item) {
            return ($item->quantity * $item->product_price) - ($item->quantity * $item->product_cost);
        });

        return $result->sum();
    }

    /**
     * Calcula los gastos totales que estan pagos
     * @return float
     */
    public function getTotalExpenses(): float
    {
        return Expense::where('is_paid', true)->get()->sum('amount');
    }

    /**
     * Calcula la utilidad total con esta formula
     * ganacias totales - gastos totales
     * @return float
     */
    public function getTotalUtility() // ventas totales - gastos totales
    {
        return $this->getTotalSales() - $this->getTotalExpenses();
    }

    /**
     * Retorna las ventas totales
     * ganacias totales - gastos totales
     * @return float
     */
    public function getTotalSales()
    {
        $productSale = DB::table('sales')
            ->join('product_sale', 'sales.id', '=', 'product_sale.sale_id')
            ->select('product_sale.quantity', 'product_sale.product_price', 'product_cost')
            ->where('sales.is_paid', true)
            ->get();

        $result = $productSale->map(function ($item) {
            return ($item->quantity * $item->product_price);
        });

        return $result->sum();
    }

    public function getDeudasPorPagar()
    {

        $expenses = Expense::where('is_paid', false)->get();

        return [
            'count' => $expenses->count(),
            'amount' => $expenses->sum('amount')
        ];
    }

    public function getDeudasPorCobrar()
    {

        $expenses = DB::table('sales')
            ->join('product_sale', 'sales.id', '=', 'product_sale.sale_id')
            ->select('product_sale.quantity', 'product_sale.product_price')
            ->where('sales.is_paid', false)
            ->get();

        $amount = $expenses->map(function ($item, $key) {
            return $item->quantity * $item->product_price;
        });

        return [
            'count' => $expenses->count(),
            'amount' => $amount->sum()
        ];
    }

    public function getClientesConMasVentas()
    {

        $sales = Sale::where('is_paid', true)
            ->where('client_id', '!=', null)
            ->get();

        $order = $sales->groupBy('client_id');


        $count = $order->map(function ($item) {
            return [
                'count' => $item->count(),
                'client' => $item[0]->client->first_name . ' ' . $item[0]->client->last_name
            ];
        });

        $sorted = $count->sortByDesc('count');

        return $sorted->values()->all();
    }

}

