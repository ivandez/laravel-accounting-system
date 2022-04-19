<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(15);

        $productsCount = Product::count();

        $section = 'Productos';

        return view('products.index', compact('products', 'productsCount', 'section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documentsTypes = DocumentType::all();

        $section = 'Crear productos';

        return view('products.create', compact('documentsTypes', 'section'));
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
            'nombre' => 'required|max:254',
            'cantidad' => 'required|int',
            'precio_unitario' => 'required|int',
            'costo_unitario' => 'required|int',
        ]);

        $product = new Product();

        $product->name = $request->nombre;

        $product->description = $request->descripcion;

        $product->cost_price = $request->costo_unitario;

        $product->unit_price = $request->precio_unitario;

        $product->quantity = $request->cantidad;

        $product->serial_number = Product::getSerialNumber();

        $product->save();

        return redirect()->route('products.index')->with('success', '¡Producto agregado exitosamente!');
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
    public function edit(Product $product)
    {
        $documentsTypes = DocumentType::all();

        $section = 'Editar producto';

        return view('products.edit', compact(['product', 'documentsTypes', 'section']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nombre' => 'required|max:254',
            'cantidad' => 'required|int',
            'costo_de_venta' => 'required|numeric',
            'costo_unitario' => 'required|numeric',
        ]);

        $product->name = $request->nombre;

        $product->description = $request->descripcion;

        $product->cost_price = $request->costo_de_venta;

        $product->unit_price = $request->costo_unitario;

        $product->quantity = $request->cantidad;

        $product->save();

        return redirect()->route('products.index')->with('success', '¡Producto actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        try {
            $product->delete();
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('fail', 'No se puede eliminar el producto porque tiene ventas asociadas');
        }

        return redirect()->route('products.index')->with('success', '¡Producto eliminado exitosamente!');
    }

    public function query(Request $request)
    {
        $products =  Product::where('name', 'LIKE',"%{$request->parametro}%")
            ->orWhere('unit_price', 'LIKE',"%{$request->parametro}%")
            ->orWhere('cost_price', 'LIKE',"%{$request->parametro}%")
            ->orWhere('description', 'LIKE',"%{$request->parametro}%")
            ->orWhere('quantity', 'LIKE',"%{$request->parametro}%")
            ->orWhere('serial_number', 'LIKE',"%{$request->parametro}%")
            ->paginate(15);

        $productsCount = Product::count();

        return view('products.index')->with('products', $products)->with('parametro', $request->parametro)
            ->with('productsCount', $productsCount);
    }
}
