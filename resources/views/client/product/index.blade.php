@extends('base')

@section('titulo', 'Nossos Estilos')
@section('conteudo')

<section class="hero-banner-small py-5 bg-light">
    <div class="container">
        <div class="text-center">
            <h2 class="display-4 fw-bold mb-3">Nossos Produtos</h2>
            <p class="lead text-muted">Cervejas artesanais produzidas com os melhores ingredientes</p>
        </div>
    </div>
</section>

<section id="produtos" class="products-section py-5">
    <div class="container">


        @if($products->isEmpty())
        <div class="text-center py-5">
            <p class="lead text-muted">Em breve novos estilos serão adicionados!</p>
        </div>
        @else
        <div class="products-grid">
            @foreach($products as $product)
            <div class="product-card">
                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="product-image" alt="{{ $product->name }}">
                @else
                <div class="product-image-placeholder">
                    <i class="bi bi-cup-straw"></i>
                </div>
                @endif
                <div class="product-content">
                    <h5 class="product-title">{{ $product->name }}</h5>
                    <p class="product-style">{{ $product->style->name }}</p>
                    <p class="product-description">{{ \Illuminate\Support\Str::limit($product->description, 80) }}</p>
                    <div class="product-footer d-flex justify-content-between align-items-center">
                        <span class="product-price">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                        <button class="btn btn-sm btn-primary add-to-cart" data-product-id="{{ $product->id }}">
                            <i class="bi bi-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

@endsection