
@extends('base.main')

@section('content')
<div class="container">
    <h1>Logs de Auditoria</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Ação</th>
                <th>Modelo</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($audits as $audit)
            <tr>
                <td>{{ $audit->id }}</td>
                <td>{{ $audit->user_id }}</td>
                <td>{{ $audit->action }}</td>
                <td>{{ $audit->model }}</td>
                <td>{{ $audit->created_at->format('d/m/Y H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
