<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    public function index()
    {
        $receitas = Receita::all(); // Obtém todas as receitas
    $totalValor = $receitas->sum('valor'); // Calcula o total dos valores das receitas
    return view('receita', compact('receitas', 'totalValor'));
    }

    public function create()
    {
        return view('rcreate');
    }

    public function store(Request $request)
    {
        Receita::create($request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'status' => 'required|in:pago,pendente',
        ]));
        return redirect()->route('receita')->with('success', 'Receita adicionada!');
    }

    public function edit(Receita $receita)
    {
        return view('redit', compact('receita'));
    }

    public function update(Request $request, Receita $receita)
    {
        $receita->update($request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'status' => 'required|in:pago,pendente',
        ]));
        return redirect()->route('receita')->with('success', 'Receita atualizada!');
    }

    public function destroy(Receita $receita)
    {
        $receita->delete();
        return redirect()->route('receita')->with('success', 'Receita deletada!');
    }
}
