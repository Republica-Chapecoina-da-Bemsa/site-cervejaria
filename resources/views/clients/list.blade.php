<div class="container">
    <h1>Clients List</h1>
    <a href="{{ route("clients.create")}}">New</a>
    <form action="{{route("clients.search")}}" method="get">
        <div>
            <label for="value">Search:</label>
            <input type="text" name="value" id="value">
        </div>
        <div>
            <select name="column" id="column">
                <option value="email">Email</option>
                <option value="name">Name</option>
                <option value="address">Address</option>
            </select>
        </div>
        <button type="submit">Buscar</button>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->address }}</td>
                    <td>
                        <form action="{{route("clients.destroy", $client)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Deletar</button>
                        </form>
                        <a href="{{route("clients.edit", $client)}}">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
