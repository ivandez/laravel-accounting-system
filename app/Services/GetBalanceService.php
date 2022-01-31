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
    public function getTotalEarnings(): float
    {
        $productSale = DB::table('sales')
            ->join('product_sale', 'sales.id', '=', 'product_sale.sale_id')
            ->select('product_sale.quantity', 'product_sale.product_price', 'product_cost')
            ->where('sales.is_paid', true)
            ->get();

        $result = $productSale->map(function ($item) {
            return ( $item->quantity * $item->product_price ) - ( $item->quantity * $item->product_cost );
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
    public function getTotalUtility(): float
    {
        return $this->getTotalEarnings() - $this->getTotalExpenses();
    }

}
