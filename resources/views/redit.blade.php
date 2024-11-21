@extends('base.main')

@section('content')
<div class="container mt-5">
    <h1>Editar Receita</h1>
    <form action="{{ route('receitas.update', $receita->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Método PUT é necessário para atualização -->

        <!-- Campo Descrição -->
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao"
                   value="{{ $receita->descricao }}" required>
        </div>

        <!-- Campo Valor -->
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="number" step="0.01" class="form-control" id="valor" name="valor"
                   value="{{ $receita->valor }}" required>
        </div>

        <!-- Campo Status -->
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="pago" {{ $receita->status == 'pago' ? 'selected' : '' }}>Pago</option>
                <option value="pendente" {{ $receita->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
            </select>
        </div>

        <!-- Botão Salvar -->
        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ route('receita') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
