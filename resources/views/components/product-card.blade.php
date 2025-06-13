@props(['product'])

<div class="card h-100">
    @if($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
    @endif
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text flex-grow-1">{{ $product->description }}</p>
        <div class="mt-auto">
            <p class="card-text mb-1"><small class="text-muted">Estilo: {{ $product->style->name }}</small></p>
            <p class="card-text mb-3"><strong>R$ {{ number_format($product->price, 2, ',', '.') }}</strong></p>
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning w-100">Editar</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="post" class="w-100">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Tem certeza?')">Deletar</button>
                </form>
            </div>
        </div>
    </div>
</div>