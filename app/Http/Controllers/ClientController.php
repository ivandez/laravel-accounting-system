<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(15);

        $section = 'Clientes';

        return view('clients.index', compact('clients', 'section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documentsTypes = DocumentType::all();

        return view('clients.create', compact('documentsTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|max:254',
        ]);

        $client = new Client();

        $client->first_name = $request->nombres;

        $client->last_name = $request->apellidos;

        $client->phone_number = $request->telefono;

        $client->comment = $request->comentario;

        if ($request->documento) {
            $client->document = $request->documento;
            $client->documentType()->associate(DocumentType::find($request->tipo_de_documento));
        }

        $client->save();

        return redirect()->route('clients.index')->with('success', '¡Cliente agregado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $documentsTypes = DocumentType::all();

        return view('clients.edit', compact(['client', 'documentsTypes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nombres' => 'required|max:254',
        ]);

        $client->first_name = $request->nombres;

        $client->last_name = $request->apellidos;

        $client->phone_number = $request->telefono;

        $client->comment = $request->comentario;

        if (!$request->documento) {
            $client->documentType()->dissociate();
        } else {
            $client->documentType()->associate(DocumentType::find($request->tipo_de_documento));
        }

        $client->document = $request->documento;

        $client->save();

        return redirect()->route('clients.index')->with('success', '¡Cliente actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {

        try {

            $client->delete();
        } catch (\Exception $e) {
            return redirect()->route('clients.index')->with('fail', 'No se puede eliminar este cliente porque tiene ventas asociadas');
        }

        return redirect()->route('clients.index')->with('success', '¡Cliente eliminado exitosamente!');
    }

    public function query(Request $request)
    {
        $clients =  Client::where('first_name', 'LIKE', "%{$request->parametro}%")
            ->orWhere('last_name', 'LIKE', "%{$request->parametro}%")
            ->orWhere('document', 'LIKE', "%{$request->parametro}%")
            ->orWhere('phone_number', 'LIKE', "%{$request->parametro}%")
            ->orWhere('comment', 'LIKE', "%{$request->parametro}%")
            ->paginate(15);

        return view('clients.index')->with('clients', $clients)->with('parametro', $request->parametro);
    }
}
