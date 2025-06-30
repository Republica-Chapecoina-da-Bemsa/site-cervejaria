@extends('base')

@section('titulo', $style->name)
@section('conteudo')

<section class="hero-banner-small py-5 bg-light">
    <div class="container">
        <div class="text-center mt-4">
            <h1 class="display-4 fw-bold mb-3">{{ $style->name }}</h1>
            <p class="lead text-muted">{{ $style->description }}</p>
        </div>
    </div>
</section>

<section class="products-section py-5">
    <div class="container">
        @if($style->products->isEmpty())
        <div class="text-center py-5">
            <p class="lead text-muted">Ainda não temos cervejas deste estilo disponíveis.</p>
            <a href="{{ route('styles.list') }}" class="btn btn-primary mt-3">Ver Outros Estilos</a>
        </div>
        @else
        <div class="row g-4">
            @foreach($style->products as $product)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm product-card">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top product-image" alt="{{ $product->name }}">
                    @else
                    <div class="product-image-placeholder card-img-top d-flex align-items-center justify-content-center">
                        <i class="bi bi-cup-straw" style="font-size: 4rem; color: #6c757d;"></i>
                    </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted flex-grow-1">{{ $product->description }}</p>
                        <div class="product-details mt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="product-price">R$ {{ number_format($product->price, 2, ',', '.') }}</span>

                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button class="btn btn-sm btn-primary add-to-cart" data-product-id="{{ $product->id }}">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>



@endsection