<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::paginate(15);

        $section = 'Proveedores';

        return view('providers.index', compact('providers', 'section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documentsTypes = DocumentType::all();

        return view('providers.create', compact('documentsTypes'))->with('section', 'Agregar proveedor');
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

        $provider = new Provider();

        $provider->first_name = $request->nombres;

        $provider->last_name = $request->apellidos;

        $provider->phone_number = $request->telefono;

        $provider->comment = $request->comentario;

        if ($request->documento) {
            $provider->document = $request->documento;
            $provider->documentType()->associate(DocumentType::find($request->tipo_de_documento));
        }

        $provider->save();

        return redirect()->route('providers.index')->with('success', '¡Proveedor agregado exitosamente!');
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
    public function edit(Provider $provider)
    {
        $documentsTypes = DocumentType::all();

        return view('providers.edit', compact(['provider', 'documentsTypes']))->with('section', 'Editar proveedor');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $request->validate([
            'nombres' => 'required|max:254',
        ]);

        $provider->first_name = $request->nombres;

        $provider->last_name = $request->apellidos;

        $provider->phone_number = $request->telefono;

        $provider->comment = $request->comentario;

        if (!$request->documento) {
            $provider->documentType()->dissociate();
        } else {
            $provider->documentType()->associate(DocumentType::find($request->tipo_de_documento));
        }

        $provider->document = $request->documento;

        $provider->save();

        return redirect()->route('providers.index')->with('success', '¡Proveedor actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();

        return redirect()->route('providers.index')->with('success', '¡Proveedor eliminado exitosamente!');
    }

    public function query(Request $request)
    {
        $providers =  Provider::where('first_name', 'LIKE', "%{$request->parametro}%")
            ->orWhere('last_name', 'LIKE', "%{$request->parametro}%")
            ->orWhere('document', 'LIKE', "%{$request->parametro}%")
            ->orWhere('phone_number', 'LIKE', "%{$request->parametro}%")
            ->orWhere('comment', 'LIKE', "%{$request->parametro}%")
            ->paginate(15);

        return view('providers.index')->with('providers', $providers)->with('parametro', $request->parametro);
    }
}
