@extends('base.main')

@section('content')
<div class="container">
    <h1>{{ isset($despesa) ? 'Editar Despesa' : 'Adicionar Despesa' }}</h1>
    <form action="{{ isset($despesa) ? route('despesas.update', $despesa) : route('despesas.store') }}" method="POST">
        @csrf
        @if(isset($despesa)) @method('PUT') @endif
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" name="descricao" value="{{ $despesa->descricao ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="number" step="0.01" class="form-control" name="valor" value="{{ $despesa->valor ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status">
                <option value="pago" {{ (isset($despesa) && $despesa->status == 'pago') ? 'selected' : '' }}>Pago</option>
                <option value="pendente" {{ (isset($despesa) && $despesa->status == 'pendente') ? 'selected' : '' }}>Pendente</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
