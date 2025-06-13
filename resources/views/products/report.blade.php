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
                <th>Estilo</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->style->name }}</td>
                <td>{{ $item->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
