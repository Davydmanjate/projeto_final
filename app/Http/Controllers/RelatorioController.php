<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use App\Models\Despesa;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index()
    {
        $totalReceitas = Receita::sum('valor');
        $totalDespesas = Despesa::sum('valor');
        $saldo = $totalReceitas - $totalDespesas;

        return view('relatorio', compact('totalReceitas', 'totalDespesas', 'saldo'));
    }
}

