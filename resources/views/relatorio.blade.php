@extends('base.main')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Relatório Financeiro</h1>
    <hr>

    <!-- Tabela de Resumo -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th><a href="{{ route('receita') }}" class="text-decoration-none">Total de Receitas</a></th>
                <th><a href="{{ route('despesa') }}" class="text-decoration-none">Total de Despesas</a></th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>MZN {{ number_format($totalReceitas, 2, ',', '.') }}</td>
                <td>MZN {{ number_format($totalDespesas, 2, ',', '.') }}</td>
                <td class="{{ $saldo >= 0 ? 'text-success' : 'text-danger' }}">
                    MZN {{ number_format($saldo, 2, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

     <!-- Gráficos -->
     <div class="mt-5">
        <h3 class="text-center">Gráficos</h3>
        <canvas id="financeChart" width="400" height="200"></canvas>
    </div>
</div>

<!-- Scripts para Gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('financeChart').getContext('2d');

    // Cálculos das percentagens
    const receitaPercent = 100;  // Receitas são sempre 100%
    const despesaPercent = ({{ $totalDespesas }} / {{ $totalReceitas }}) * 100;  // Percentual das Despesas
    const saldoPercent = (({{ $totalReceitas }} - {{ $totalDespesas }}) / {{ $totalReceitas }}) * 100;  // Percentual do Saldo

    const financeChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Receitas', 'Despesas', 'Saldo'],
            datasets: [{
                label: 'Percentagem (%)',
                data: [receitaPercent, despesaPercent, saldoPercent],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.6)', // Cor para receitas
                    'rgba(255, 99, 132, 0.6)', // Cor para despesas
                    'rgba(54, 162, 235, 0.6)'  // Cor para saldo
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100 // Define o limite máximo como 100%
                }
            },
            plugins: {
                legend: {
                    display: false  // Não exibe a legenda
                }
            }
        }
    });
</script>
@endsection
