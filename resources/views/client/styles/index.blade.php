@extends('base')

@section('titulo', 'Nossos Estilos')
@section('conteudo')

<section class="hero-banner-small py-5 bg-light">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">Nossos Estilos de Cerveja</h1>
            <p class="lead text-muted">Explore nossa variedade de estilos artesanais cuidadosamente elaborados</p>
        </div>
    </div>
</section>

<section class="styles-section py-5">
    <div class="container">
        @if($styles->isEmpty())
        <div class="text-center py-5">
            <p class="lead text-muted">Em breve novos estilos serão adicionados!</p>
        </div>
        @else
        <div class="row g-4">
            @foreach($styles as $style)
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('styles.show', $style->id) }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm style-card">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title text-primary mb-3">{{ $style->name }}</h4>
                            <p class="card-text text-muted flex-grow-1">{{ $style->description }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-secondary">{{ $style->products_count }} {{ $style->products_count == 1 ? 'cerveja' : 'cervejas' }}</span>
                                <span class="text-primary">
                                    Ver detalhes <i class="bi bi-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>



@endsection