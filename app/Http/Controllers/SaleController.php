<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;


class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::where('is_paid', true)->latest()->paginate(15);

        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'productos' => 'required',
            'metodo_de_pago' => 'required',
            'pagado' => 'required',
            'fecha' => 'required',
        ]);

        // Check if products has stock
        foreach ($request->productos as $product){

            $hasStock = Product::hasStock($product['id'], $product['quantity']);

            if(!$hasStock){
                return response()->json('no stock', 422);
            }
        }

        $sale = new Sale();

        $sale->comment = $request->comentario;

        $sale->is_paid = $request->pagado;

        $sale->date = $request->fecha;

        $sale->client()->associate(Client::find($request->clientId));

        $sale->payment_method_id = $request->metodo_de_pago;

        $sale->save();

        foreach ($request->productos as $product){
            $p = Product::find($product['id']);

            $p->quantity -= $product['quantity'];

            $p->save();

            $sale->products()->attach($product['id'],
                [
                    'quantity' => $product['quantity'],
                    'product_price' => $product['product_price'],
                    'product_cost' => $p->cost_price,
                ]);
        }

        return 'exitooo';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {

        return view('sales.show')->with('sale', $sale);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {

        foreach ($sale->products as $product){
            $p = Product::find($product['id']);

            $p->quantity += $product->pivot->quantity;

            $p->save();
        }

        $sale->products()->detach();

        $sale->delete();

        return redirect()->route('sales.index')->with('success', '¡Venta eliminada exitosamente!');
    }

    public function query()
    {
        return 'look for sale uh? xd';
    }

    public function toPay()
    {
        $sales = Sale::where('is_paid', false)->get();

        return view('sales.to-pay')->with('sales', $sales);
    }

    public function updateStatus(Sale $sale)
    {
        $sale->is_paid = true;

        $sale->save();

        return redirect()->route('sales.toPay')->with('success', '¡Venta pagada exitosamente!');
    }
}
