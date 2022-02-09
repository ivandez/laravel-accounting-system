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
        return view('bussines');
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
    public function update(Request $request, Bussines $bussines)
    {
        //
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
