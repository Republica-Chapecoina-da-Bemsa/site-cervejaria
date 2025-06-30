<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Receipt Report</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .report-container {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            padding: 32px;
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .header h2 {
            margin: 0;
            color: #2c3e50;
        }

        .info-table,
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        .info-table td {
            padding: 6px 0;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        .items-table th {
            background: #f1f3f5;
        }

        .total-row td {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            color: #888;
            font-size: 13px;
            margin-top: 32px;
        }
    </style>
</head>

<body>
    <div class="report-container">
        <div class="header">
            <h2>Receipt Report</h2>
            <p>{{ date('d/m/Y H:i') }}</p>
        </div>
        <table class="info-table">
            <tr>
                <td><strong>Receipt #:</strong></td>
                <td>{{ $receipt->id ?? '---' }}</td>
            </tr>
            <tr>
                <td><strong>Status:</strong></td>
                <td>{{ $receipt->status ?? '---' }}</td>
            </tr>
            <tr>
                <td><strong>Payment Method:</strong></td>
                <td>{{ $receipt->payment_method ?? '---' }}</td>
            </tr>
            <tr>
                <td><strong>Date:</strong></td>
                <td>{{ \Carbon\Carbon::parse($receipt->created_at ?? null)->format('d/m/Y H:i') ?? '---' }}</td>
            </tr>
        </table>
        <table class="items-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @php
                $products = is_string($receipt->products ?? '') ? json_decode($receipt->products) : ($receipt->products ?? []);
                @endphp
                @forelse($products as $i => $product)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $product->name ?? '---' }}</td>
                    <td>{{ $product->quantity ?? '---' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align:center;">No products found.</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="2" style="text-align:right;">Total:</td>
                    <td>R$ {{ number_format($receipt->total_amount ?? 0, 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
        <div class="footer">
            Thank you for your purchase!<br>
            Projeto Cervejaria &copy; {{ date('Y') }}
        </div>
    </div>
</body>

</html>