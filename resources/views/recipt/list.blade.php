
<div class="container">
    <h1>Receipts List</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Total Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Products</th>
            </tr>
        </thead>
        <tbody>
            @forelse($receipts as $receipt)
                <tr>
                    <td>{{ $receipt->id }}</td>
                    <td>{{ $receipt->total_amount }}</td>
                    <td>{{ $receipt->payment_method }}</td>
                    <td>{{ $receipt->status }}</td>
                    <td>
                        @if(is_array($receipt->products) || is_object($receipt->products))
                            <ul>
                                @foreach($receipt->products as $product)
                                    <li>{{ $product }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{ $receipt->products }}
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No receipts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
