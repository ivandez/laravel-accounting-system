<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\GetBalanceService;

class StatisticController extends Controller
{
    private GetBalanceService $balanceService;

    public function __construct(GetBalanceService $balanceService)
    {
        $this->balanceService = $balanceService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =  Product::getMoreSellerProducts();

        $clientesConMasVentas = $this->balanceService->getClientesConMasVentas();

        $deudasPorCobrar = $this->balanceService->getDeudasPorCobrar();

        $deudasPorPagar = $this->balanceService->getDeudasPorPagar();

        return view('statistic.index')
            ->with('products', $products)
            ->with('clientesMasVentas', $clientesConMasVentas)
            ->with('deudasPorCobrar', $deudasPorCobrar)
            ->with('deudasPorPagar', $deudasPorPagar);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
