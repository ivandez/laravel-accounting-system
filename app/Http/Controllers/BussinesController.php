<?php

namespace App\Http\Controllers;

use App\Models\Bussines;
use Illuminate\Http\Request;

class BussinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Bussines::first();

        return view('bussines')->with('empresa', $empresa)->with('section', 'Empresa');
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
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bussines  $bussines
     * @return \Illuminate\Http\Response
     */
    public function show(Bussines $bussines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bussines  $bussines
     * @return \Illuminate\Http\Response
     */
    public function edit(Bussines $bussines)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bussines  $bussines
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bussines $empresa)
    {
        $empresa->name = $request->name;
        $empresa->rif = $request->rif;
        $empresa->address = $request->address;
        $empresa->phone_number1 = $request->phone_number1;
        $empresa->phone_number2 = $request->phone_number2;
        $empresa->email = $request->email;

        $empresa->save();

        return redirect()->back()->with('success', '¡Datos guardados exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bussines  $bussines
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bussines $bussines)
    {
        //
    }
}
