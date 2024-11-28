<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use App\Models\Audit; // Importando o modelo de auditoria
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Usando a autenticação para registrar o usuário que fez a ação

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
        // Validação dos dados
        $validatedData = $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'status' => 'required|in:pago,pendente',
        ]);

        // Criação da receita
        $receita = Receita::create($validatedData);

        // Registrar a auditoria da criação
        Audit::create([
            'user_id' => Auth::id(), // ID do usuário logado
            'action' => 'create', // Tipo da ação
            'model' => 'receita', // Nome do modelo afetado
            'data_before' => null, // Não há dados antes da criação
            'data_after' => $receita->toJson(), // Dados após a criação (como JSON)
        ]);

        // Redireciona após a criação
        return redirect()->route('receita')->with('success', 'Receita adicionada!');
    }

    public function edit(Receita $receita)
    {
        return view('redit', compact('receita'));
    }

    public function update(Request $request, Receita $receita)
    {
        // Guardar os dados antes da atualização
        $dataBefore = $receita->toJson();

        // Validação e atualização dos dados
        $validatedData = $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'status' => 'required|in:pago,pendente',
        ]);

        // Atualizando a receita
        $receita->update($validatedData);

        // Registrar a auditoria da atualização
        Audit::create([
            'user_id' => Auth::id(), // ID do usuário logado
            'action' => 'update', // Tipo da ação
            'model' => 'receita', // Nome do modelo afetado
            'data_before' => $dataBefore, // Dados antes da atualização
            'data_after' => $receita->toJson(), // Dados após a atualização (como JSON)
        ]);

        // Redireciona após a atualização
        return redirect()->route('receita')->with('success', 'Receita atualizada!');
    }

    public function destroy(Receita $receita)
    {
        // Guardar os dados antes da exclusão
        $dataBefore = $receita->toJson();

        // Deletando a receita
        $receita->delete();

        // Registrar a auditoria da exclusão
        Audit::create([
            'user_id' => Auth::id(), // ID do usuário logado
            'action' => 'delete', // Tipo da ação
            'model' => 'receita', // Nome do modelo afetado
            'data_before' => $dataBefore, // Dados antes da exclusão
            'data_after' => null, 
        ]);

        // Redireciona após a exclusão
        return redirect()->route('receita')->with('success', 'Receita deletada!');
    }
}
