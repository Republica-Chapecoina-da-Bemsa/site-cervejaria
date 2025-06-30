@extends('baseadm')
@section('titulo', 'Lista de Fornecedores')

@section('conteudo')
<div class="container">
    <h1 class="mt-4">Lista de Fornecedores</h1>
    <div class="container mb-2">
        <div>
            <form action="{{ route('suppliers.search') }}" method="get" class="d-flex align-items-center gap-1">
                <select name="column" id="column" class="form-select" style="width: 200px;">
                    <option value="name">Nome</option>
                    <option value="email">Email</option>
                    <option value="address">Endereço</option>
                </select>

                <div class="input-group">
                    <input type="text" class="form-control" name="value" id="value" placeholder="Buscar">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>

                <a href="{{ route('suppliers.create') }}" class="btn btn-success">Novo</a>
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
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->email }}</td>
                <td>{{ $supplier->phone }}</td>
                <td>{{ $supplier->address }}</td>
                <td class="flex">
                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este fornecedor?')">
                            Deletar
                        </button>
                    </form>
                    <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning">Editar</a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
