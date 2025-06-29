 <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->product->price }}</td>
            </tr>
            @endforeach
        </tbody>
        <form method="POST" action="{{ route('cart.checkout') }}">

            @csrf
            <input type="text" name="paymentMethod">
            <button type="submit">Submit</button>
        </form>
    </table>
