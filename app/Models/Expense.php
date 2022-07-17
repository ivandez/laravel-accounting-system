<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class,);
    }
}
