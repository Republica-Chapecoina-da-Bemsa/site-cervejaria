@extends('baseadm')
@section('titulo', 'Lista de Produtos')

@section('conteudo')
<div class="container">
    <h1 class="mt-4">{{ $style->name }} - Lista de Produtos</h1>

    <div class="container mb-2">
        <form action="{{ route('styles.products.search', $style->id) }}" method="get" class="d-flex align-items-center gap-1">
            <div class="input-group">
                <input type="text" name="value" id="value" class="form-control" placeholder="Buscar">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>

            <select name="column" id="column" class="form-select" style="width: 200px;">
                <option value="name">Nome</option>
                <option value="description">Descrição</option>
            </select>

            <a href="{{ route('styles.products.create', $style->id) }}" class="btn btn-success">Novo</a>
        </form>
    </div>

    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Estilo</th>
                <th>Imagem</th>
                <th>Ações</th>
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
                    Sem imagem
                    @endif
                </td>
                <td class="flex">
                    <form action="{{ route('styles.products.destroy', [$style->id, $product->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este produto do estilo?')">
                            Deletar
                        </button>
                    </form>
                    <a href="{{ route('styles.products.edit', [$style->id, $product->id]) }}" class="btn btn-warning">Editar</a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection