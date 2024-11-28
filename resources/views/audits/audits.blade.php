@extends('base.main')

@section('content')
<div class="container">
    <h1>Logs de Auditoria</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>Evento</th>
                <th>Usuário</th>
                <th>Mudanças</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($audits as $audit)
            <tr>
                <td>{{ $audit->id }}</td>
                <td>{{ $audit->auditable_type }}</td>
                <td>{{ $audit->event }}</td>
                <td>{{ optional($audit->user)->name }}</td>
                <td>
                    <strong>Antes:</strong> {{ json_encode($audit->old_values) }}<br>
                    <strong>Depois:</strong> {{ json_encode($audit->new_values) }}
                </td>
                <td>{{ $audit->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $audits->links() }}
</div>
@endsection
