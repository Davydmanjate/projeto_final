@extends('base.main')

@section('content')
<div class="container">
    <h1>Despesas</h1>
    <a href="{{ route('dcreate') }}" class="btn btn-primary mb-3">Adicionar Despesa</a>
    <a href="{{ route('receita') }}" class="btn btn-primary mb-3">Recitas</a>
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
            @foreach ($despesas as $despesa)
            <tr>
                <td>{{ $despesa->id }}</td>
                <td>{{ $despesa->descricao }}</td>
                <td>{{ number_format($despesa->valor, 2, ',', '.') }}</td> <!-- Formato brasileiro -->
                <td>{{ $despesa->status }}</td>
                <td>
                    <a href="{{ route('dedit', $despesa) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('despesas.destroy', $despesa) }}" method="POST" style="display:inline-block;">
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
