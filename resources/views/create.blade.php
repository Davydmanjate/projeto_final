@extends('base.main')

@section('content')
<div class="container">
    <h1>Nova Receita</h1>
    <form action="{{ route('receitas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" id="descricao" name="descricao" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="number" id="valor" name="valor" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control">
                <option value="Pendente">Pendente</option>
                <option value="Recebido">Recebido</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('receita') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
