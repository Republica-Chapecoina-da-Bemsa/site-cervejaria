@extends ('base')

<div class="container">
    <h1 class="mt-4">Lista de Eventos</h1>

    <div class="container mb-2">
        <form action="{{ route('events.search') }}" method="get" class="d-flex align-items-center gap-1">
            <select name="column" id="column" class="form-select" style="width: 200px;">
                <option value="name">Nome</option>
                <option value="location">Localização</option>
            </select>

            <div class="input-group">
                <input type="text" name="value" id="value" class="form-control" placeholder="Buscar">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>

            <a href="{{ route('events.create') }}" class="btn btn-success">Novo</a>
        </form>
    </div>

    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Localização</th>
                <th>Data</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->description }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->date }}</td>
                    <td>
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" width="100">
                        @else
                            Sem imagem
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('events.destroy', $event) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
