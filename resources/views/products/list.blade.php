<div class="container">
    <h1>Products List</h1>
    <a href="{{ route("products.create")}}">New</a>
    <form action="{{route("products.search")}}" method="get">
        <div>
            <label for="value">Search:</label>
            <input type="text" name="value" id="value">
        </div>
        <div>
            <select name="column" id="column">
                <option value="name">Name</option>
                <option value="description">Description</option>
            </select>
        </div>
        <button type="submit">Buscar</button>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Style</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->style->name }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100">
                        @else
                            No image
                        @endif
                    <td>
                        <form action="{{route("products.destroy", $product->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Deletar</button>
                        </form>
                        <a href="{{route("products.edit", $product->id)}}">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
