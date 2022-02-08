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
}
