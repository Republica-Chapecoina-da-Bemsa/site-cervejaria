@extends('base')
@section('titulo', 'Carrinho de Compras')

@section('conteudo')
<div class="container mt-4">
    <h1 class="mb-4">Seu Carrinho de Compras</h1>

    @if($cart->isEmpty())
    <div class="alert alert-info" role="alert">
        Seu carrinho está vazio.
    </div>
    <a href="{{ route('products.list') }}" class="btn btn-primary">Ver Produtos</a>
    @else
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Produto</th>
                <th>Preço Unitário</th>
                <th>Quantidade</th> {{-- Coluna para ajuste de quantidade --}}
                <th>Total do Item</th>
                <th>Ações</th> {{-- Coluna para remover item --}}
            </tr>
        </thead>
        <tbody>
            @php
            $totalCart = 0;
            @endphp
            @foreach($cart as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->product->name }}</td>
                <td>R$ {{ number_format($item->product->price, 2, ',', '.') }}</td>
                <td>
                    <form action="{{ route('cart.update_item', $item->product->id) }}" method="POST" class="d-flex align-items-center gap-2">
                        @csrf
                        @method('PUT')
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm" style="width: 70px;">
                        <button type="submit" class="btn btn-sm btn-outline-dark" title="Atualizar Quantidade">
                            <i class="bi bi-arrow-repeat">‎ ‎ Atualizar carrinho</i>
                        </button>
                    </form>
                </td>
                <td>R$ {{ number_format($item->quantity * $item->product->price, 2, ',', '.') }}</td>
                <td>
                    {{-- Formulário para remover o item --}}
                    <form action="{{ route('cart.remove', $item->product->id) }}" method="POST">
                        @csrf
                        @method('DELETE') {{-- Usamos DELETE para remoção --}}
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja remover este item do carrinho?')" title="Remover Item">
                            <i class="bi bi-trash"></i> {{-- Ícone de lixeira --}}
                        </button>
                    </form>
                </td>
            </tr>
            @php
            $totalCart += ($item->quantity * $item->product->price);
            @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-end"><strong>Total do Carrinho:</strong></td>
                <td colspan="2"><strong>R$ {{ number_format($totalCart, 2, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-warning" onclick="return confirm('Tem certeza que deseja limpar todo o carrinho?')">Limpar Carrinho</button>
        </form>
        <a href="{{ route('products.list') }}" class="btn btn-secondary">Continuar Comprando</a>
    </div>


    <div class="mt-4">
        <h3>Finalizar Pedido</h3>
        <form method="POST" action="{{ route('cart.checkout') }}" class="d-flex flex-column gap-3">
            @csrf
            <div class="form-group">
                <label for="paymentMethod">Método de Pagamento:</label>
                <select name="paymentMethod" id="paymentMethod" class="form-control" required>
                    <option value="" disabled selected>Selecione o método de pagamento</option>
                    <option value="cartao">Cartão de Crédito</option>
                    <option value="pix">Pix</option>
                    <option value="boleto">Boleto</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-25">Finalizar Compra</button>
        </form>
    </div>
    @endif
</div>
@endsection
