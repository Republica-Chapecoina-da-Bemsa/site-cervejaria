@props(['event'])

<div class="card h-100">
    @if($event->image)
    <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->name }}" style="height: 200px; object-fit: cover;">
    @endif
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $event->name }}</h5>
        <p class="card-text">{{ $event->description }}</p>
        <div class="mt-auto">
            <p class="card-text"><small class="text-muted">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</small></p>
            <div class="btn-group w-100" role="group">
                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('events.destroy', $event->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Deletar</button>
                </form>
            </div>
        </div>
    </div>
</div>