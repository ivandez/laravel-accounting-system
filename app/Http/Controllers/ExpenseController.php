<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Provider;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::where('is_paid', true)->get();

        $section = "Gastos";

        return view('expenses.index')->with('expenses', $expenses)->with('section', $section);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create')->with('section', 'Crear gasto');
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
            'metodo_de_pago' => 'required',
            'pagado' => 'required',
            'fecha' => 'required',
            'monto' => 'required',
            'comentario' => 'required',
        ]);

        $expense = new Expense();

        $expense->comment = $request->comentario;

        $expense->is_paid = $request->pagado;

        $expense->date = $request->fecha;

        $expense->amount = $request->monto;

        $expense->provider()->associate(Provider::find($request->providerId));

        $expense->payment_method_id = $request->metodo_de_pago;

        $expense->save();

        return 'exitooo';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        $section = "Ver gasto";

        return view('expenses.show')->with('section', $section)->with('expense', $expense);
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
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expense.index')->with('success', '¡Gasto eliminado exitosamente!');
    }

    public function query(Request $request)
    {

        $expenses =  Expense::where('comment', 'LIKE', "%{$request->parametro}%")
            ->paginate(15);

        $section = 'Gastos';

        return view('expenses.index', compact('expenses', 'section'));
    }

    public function porPagar()
    {
        $expenses = Expense::where('is_paid', false)->get();
        $section = "Gastos por pagar";

        return view('expenses.por-pagar')->with('expenses', $expenses)->with('section', $section);
    }

    public function updateStatus(Expense $expense)
    {
        $expense->is_paid = true;

        $expense->save();

        return redirect()->route('expense.index')->with('success', '¡Pago pagado exitosamente!');
    }
}
