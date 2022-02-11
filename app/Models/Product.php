<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'product_sale');
    }

    public static function hasStock($productId, $quantity)
    {
        $product = Product::find($productId);

        if ($quantity > $product->quantity) {
            return false;
        }

        return true;
    }

    public static function getSerialNumber()
    {
        // Get the last created order
        $lastOrder = Product::orderBy('created_at', 'desc')->first();

        if (!$lastOrder)
            // We get here if there is no order at all
            // If there is no number set it to 0, which will be 1 at the end.
            $number = 0;
        else
            $number = substr($lastOrder->serial_number, 3);
        // If we have SOL0000001 in the database then we only want the number
        // So the substr returns this 0000001

        // Add the string in front and higher up the number.
        // the %07d part makes sure that there are always 7 numbers in the string.
        // so it adds the missing zero's when needed.

        return 'P' . sprintf('%07d', intval($number) + 1);
    }

    public static function getMoreSellerProducts()
    {
        // product sale organizar por producto y despues por quantity
        /**
         * sumar el qunatity
         * retornar un nuevo arreglo con el nombre y la cantidad
         * organizar de mayor a menor
         */
        $moreSellerProducts =  DB::table('product_sale')
            ->join('products', 'product_sale.product_id', '=', 'products.id')
            ->select('product_sale.*', 'products.name')
            ->get();

        $orgProducts = $moreSellerProducts->groupBy('product_id');

        $asd =  $orgProducts->map(function ($item, $key) {
            return [
                "name" => $item[0]->name,
                "quantity" => $item->sum('quantity')];
        });

        $newArray = [];

        foreach ($asd as $element){
            $newArray[] = $element;
        }

        $colecion = collect($newArray);

        $sorted = $colecion->sortBy('quantity', descending: true);

        return $sorted->values()->all();
    }

}
