<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sale')->withPivot('product_price','quantity');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class,);
    }

    public function sumProductPrice(){
        $total = 0;

        foreach ($this->products as $product) {
            $total += $product->pivot->product_price * $product->pivot->quantity;
        }

        return $total;
    }

    public static function getSerialNumber()
    {
        // Get the last created order
        $lastOrder = Sale::orderBy('created_at', 'desc')->first();

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

        return 'V' . sprintf('%07d', intval($number) + 1);
    }
}
