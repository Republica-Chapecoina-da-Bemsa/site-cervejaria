@extends ('base')
@section('titulo', 'Carrinho de Compras')

@section('conteudo')
<div class="container py-4">
    <h2 class="mb-4">
        <i class="bi bi-cart3"></i> Carrinho de Compras
    </h2>

    <div id="cart-items-container" class="mb-4">
        @if(count($cart) === 0)
        <div class="text-center py-5">
            <p class="text-muted">Seu carrinho está vazio.</p>
        </div>
        @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th>Ações</th>

                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                <tr data-price="{{ $item['price'] }}">
                    <td>{{ $item['name'] }}</td>
                    <td>R$ {{ number_format($item['price'], 2, ',', '.') }}</td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 5px;">
                            <button type="button" class="btn btn-sm btn-dark btn-decrease" style="width: 30px; text-align: center; border-radius: 20px">-</button>
                            <input type="text" value="{{ $item['quantity'] }}" class="quantity-input" style="width: 30px; text-align: center; border-radius: 5px" readonly>
                            <button type="button" class="btn btn-sm btn-dark btn-increase" style="width: 30px; text-align: center; border-radius: 20px">+</button>
                        </div>
                    </td>
                    <td class="item-subtotal">R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger btn-delete">Excluir</button>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
        @endif
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Total:</h5>
        <h5 id="cart-total">R$ {{ number_format($total, 2, ',', '.') }}</h5>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('home') }}" class="btn btn-secondary">Continuar Comprando</a>
        <form action="{{ route('pdf.finalize') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary flex-grow-1">
                Finalizar Pedido
            </button>
        </form>

    </div>
</div>
<script>
    function formatBRL(value) {
        return 'R$ ' + value.toFixed(2).replace('.', ',');
    }

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('tbody tr').forEach(row => {
            const subtotalText = row.querySelector('.item-subtotal').textContent;
            // extrair número do formato "R$ x,xx"
            const subtotal = parseFloat(subtotalText.replace('R$ ', '').replace(',', '.'));
            total += subtotal;
        });
        document.getElementById('cart-total').textContent = formatBRL(total);
    }

    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', () => {
            alert('Item deletado!');
        });
    });

    document.querySelectorAll('tbody tr').forEach(row => {
        const decreaseBtn = row.querySelector('.btn-decrease');
        const increaseBtn = row.querySelector('.btn-increase');
        const quantityInput = row.querySelector('.quantity-input');
        const subtotalCell = row.querySelector('.item-subtotal');
        const price = parseFloat(row.getAttribute('data-price'));

        if (decreaseBtn && increaseBtn && quantityInput) {
            decreaseBtn.addEventListener('click', () => {
                let current = parseInt(quantityInput.value);
                if (current > 1) {
                    current--;
                    quantityInput.value = current;
                    subtotalCell.textContent = formatBRL(price * current);
                    updateTotal();
                }
            });
            increaseBtn.addEventListener('click', () => {
                let current = parseInt(quantityInput.value);
                current++;
                quantityInput.value = current;
                subtotalCell.textContent = formatBRL(price * current);
                updateTotal();
            });
        }
    });
</script>
@endsection