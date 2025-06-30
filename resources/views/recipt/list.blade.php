@extends('baseadm')
@section('titulo', 'Lista de Recibos')

@section('conteudo')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Recibos</h1>

    <div class="mb-3">
        <a href="{{ route('recipts.items_sold_chart') }}" class="btn btn-secondary">
            <i class="bi bi-bar-chart"></i> Gráfico de Itens Vendidos
        </a>
    </div>

    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Valor Total</th>
                <th>Método de Pagamento</th>
                <th>Status</th>
                <th>Produtos</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($receipts as $receipt)
            <tr>
                <td>{{ $receipt->id }}</td>
                <td>R$ {{ number_format($receipt->total_amount, 2, ',', '.') }}</td>
                <td>{{ $receipt->payment_method }}</td>
                <td>{{ $receipt->status }}</td>
                <td>
                    @php

                    $products = json_decode($receipt->products, true);
                    @endphp
                    @if(is_array($products) && !empty($products))
                    <ul class="list-unstyled">
                        @foreach($products as $product)
                        <li>
                            <strong>{{ $product['name'] ?? 'N/A' }}</strong> ({{ $product['quantity'] ?? 'N/A' }}x)
                            - R$ {{ number_format($product['price'] ?? 0, 2, ',', '.') }}
                        </li>
                        @endforeach
                    </ul>
                    @else
                    Nenhum produto listado.
                    @endif
                </td>
                <td>
                    <a href="{{ route('recipts.generate', $receipt->id) }}" class="btn btn-sm btn-outline-primary" title="Gerar PDF do Recibo">
                        <i class="bi bi-file-earmark-pdf"></i> PDF
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Nenhum recibo encontrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection