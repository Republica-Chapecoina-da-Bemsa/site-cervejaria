@extends ('base')

<div class="container">
    <h1 class="mt-4">Lista de Clientes</h1>
    <div class="container mb-2">
        <div>
            <form action="{{ route('clients.search') }}" method="get" class="d-flex align-items-center gap-1">
                <select name="column" id="column" class="form-select" style="width: 200px;">
                    <option value="name">Nome</option>
                    <option value="email">Email</option>
                    <option value="address">Endereço</option>
                </select>

                <div class="input-group">
                    <input type="text" class="form-control" name="value" id="value" placeholder="Buscar">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>

                <a href="{{ route('clients.create') }}" class="btn btn-success">Novo</a>
            </form>
        </div>

    </div>

    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Ações</th>
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
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                        <a href="{{route("clients.edit", $client)}}" class="btn btn-warning">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
