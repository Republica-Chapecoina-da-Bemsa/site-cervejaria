<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Resumo do Pedido</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }

        .data {
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <h2>Resumo do Pedido</h2>

    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Preço Unitário</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>R$ {{ number_format($item->product->price, 2, ',', '.') }}</td>
                <td>{{ $item->quantity }}</td>
                <td>R$ {{ number_format($item->product->price * $item->quantity, 2, ',', '.') }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <p class="total">Total: R$ {{ number_format($total, 2, ',', '.') }}</p>
</body>

</html>