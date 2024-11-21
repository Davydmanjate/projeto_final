<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;

class DespesaController extends Controller
{
    public function index()
    {
        $despesas = Despesa::all(); // Obtém todas as despesas
    $totalValor = $despesas->sum('valor'); // Calcula o total dos valores das despesas
    return view('despesa', compact('despesas', 'totalValor'));
    }

    public function create()
    {
        return view('dcreate');
    }

    public function store(Request $request)
    {
        Despesa::create($request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'status' => 'required|in:pago,pendente',
        ]));
        return redirect()->route('despesa')->with('success', 'Despesa adicionada!');
    }

    public function edit(Despesa $despesa)
    {
        return view('dedit', compact('despesa'));
    }

    public function update(Request $request, Despesa $despesa)
    {
        $despesa->update($request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'status' => 'required|in:pago,pendente',
        ]));
        return redirect()->route('despesa')->with('success', 'Despesa atualizada!');
    }

    public function destroy(Despesa $despesa)
    {
        $despesa->delete();
        return redirect()->route('despesa')->with('success', 'Despesa deletada!');
    }
}
