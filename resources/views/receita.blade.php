@extends('base.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Receitas</h1>
    <a href="{{ route('rcreate') }}" class="btn btn-success">Novo</a> <!-- Botão "Novo" -->
</div>
    <a href="{{ route('rcreate') }}" class="btn btn-primary mb-3">Adicionar Receita</a>
    <a href="{{ route('despesa') }}" class="btn btn-primary mb-3">Despesas</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receitas as $receita)
            <tr>
                <td>{{ $receita->id }}</td>
                <td>{{ $receita->descricao }}</td>
                <td>{{ number_format($receita->valor, 2, ',', '.') }}</td> <!-- Formato brasileiro -->
                <td>{{ $receita->status }}</td>
                <td>
                    <a href="{{ route('redit', $receita) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('receitas.destroy', $receita) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-right"><strong>Total:</strong></td>
                <td><strong>{{ number_format($totalValor ?? 0, 2, ',', '.') }}</strong></td> <!-- Exibe o total -->
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
