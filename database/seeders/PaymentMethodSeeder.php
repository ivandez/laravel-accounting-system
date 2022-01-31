<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create([
            'name' => 'Punto de venta',
        ]);

        PaymentMethod::create([
            'name' => 'Efectivo',
        ]);

        PaymentMethod::create([
            'name' => 'Pago móvil',
        ]);

        PaymentMethod::create([
            'name' => 'Transferencia bancaria',
        ]);
    }
}
