@extends('base.main')

@section('content')
<div class="container">
    <h1>{{ isset($receita) ? 'Editar Receita' : 'Adicionar Receita' }}</h1>
    <form action="{{ isset($receita) ? route('receitas.update', $receita) : route('receitas.store') }}" method="POST">
        @csrf
        @if(isset($receita)) @method('PUT') @endif
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" name="descricao" value="{{ $receita->descricao ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="number" step="0.01" class="form-control" name="valor" value="{{ $receita->valor ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status">
                <option value="pago" {{ (isset($receita) && $receita->status == 'pago') ? 'selected' : '' }}>Pago</option>
                <option value="pendente" {{ (isset($receita) && $receita->status == 'pendente') ? 'selected' : '' }}>Pendente</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
