@extends('baseadm')
@section('titulo', 'Lista de Estilos')

@section('conteudo')
<div class="container">
    <h1 class="mt-4">Lista de Estilos</h1>

    <div class="container mb-2">
        <form action="{{ route('styles.search') }}" method="get" class="d-flex align-items-center gap-1">
            <select name="column" id="column" class="form-select" style="width: 200px;">
                <option value="name">Nome</option>
                <option value="description">Descrição</option>
            </select>

            <div class="input-group">
                <input type="text" name="value" id="value" class="form-control" placeholder="Buscar">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>


            <a href="{{ route('styles.create') }}" class="btn btn-success">Novo</a>
        </form>
    </div>

    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Produtos</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($styles as $style)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $style->name }}</td>
                <td>{{ $style->description }}</td>
                <td><a href="{{ route('styles.products.index', $style->id) }}" class="btn btn-outline-dark">Ver</a></td>
                <td class="flex">
                    <form action="{{ route('styles.destroy', $style) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este estilo?')">
                            Deletar
                        </button>
                    </form>
                    <a href="{{ route('styles.edit', $style) }}" class="btn btn-warning">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection