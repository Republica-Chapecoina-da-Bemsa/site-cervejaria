<div class="container">
    <h1>styles List</h1>
    <a href="{{ route("styles.create")}}">New</a>
    <form action="{{route("styles.search")}}" method="get">
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
                <th>products</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            @foreach($styles as $style)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $style->name }}</td>
                <td>{{ $style->description }}</td>
                <td><a href="{{route("styles.products.index",$style->id)}}">ver</a></td>
                <td>
                    <form action="{{route("styles.destroy", $style)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Deletar</button>
                    </form>
                    <a href="{{route("styles.edit", $style)}}">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
