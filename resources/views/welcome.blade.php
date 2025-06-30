@extends('base')

@section('titulo', 'Bem-vindo')
@section('conteudo')

    <section>
        <div class="container">
            <div class="row align-items-center min-vh-50">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Bem-vindo à Nossa Cervejaria</h1>
                    <p class="lead mb-4">Descubra o sabor autêntico da cerveja artesanal. Produzida com paixão, servida com
                        orgulho.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#produtos" class="btn btn-outline-dark btn-lg">Conheça Nossos Produtos</a>
                        <a href="#eventos" class="btn btn-outline-dark btn-lg">Próximos Eventos</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image text-center">
                        <div class="placeholder-hero">
                            <img src="{{ asset('images/banner.jpg') }}" alt="Banner da Cervejaria"
                                style="max-width: 100%; height: auto; border-radius: 20px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="eventos" class="events-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Próximos Eventos</h2>
                <p class="lead text-muted">Participe dos nossos eventos e degustações especiais</p>
            </div>

            @if($events->isEmpty())
                <div class="text-center py-5 rounded">
                    <p class="mb-0">Em breve novos eventos serão anunciados!</p>
                </div>
            @else
                <div class="events-scroll-wrapper">
                    <div class="d-flex flex-nowrap gap-4 overflow-auto pb-3">
                        @foreach($events as $event)
                            <div class="event-card flex-shrink-0" style="width: 300px;">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" class="event-image" alt="{{ $event->name }}">
                                @else
                                    <div class="event-image-placeholder">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                @endif
                                <div class="event-content">
                                    <h5 class="event-title">{{ $event->name }}</h5>
                                    <p class="event-description">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                                    <div class="event-meta">
                                        <small class="text-muted">
                                            <i class="bi bi-calendar3"></i>
                                            {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt"></i> {{ $event->location }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            @endif
        </div>
    </section>

    <section id="produtos" class="products-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Nossos Produtos</h2>
                <p class="lead text-muted">Cervejas artesanais produzidas com os melhores ingredientes</p>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-5 rounded">
                    <p class="mb-0">Em breve nossos produtos estarão disponíveis!</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach($products->take(8) as $product)
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="product-card h-100">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="product-image"
                                        alt="{{ $product->name }}">
                                @else
                                    <div class="product-image-placeholder">
                                        <i class="bi bi-cup-straw"></i>
                                    </div>
                                @endif
                                <div class="product-content">
                                    <h5 class="product-title">{{ $product->name }}</h5>
                                    <p class="product-style">{{ $product->style->name }}</p>
                                    <p class="product-description">{{ \Illuminate\Support\Str::limit($product->description, 80) }}
                                    </p>
                                    <div class="product-footer d-flex justify-content-between align-items-center">
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
                    @endforeach
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('products.list') }}" class="btn btn-outline-dark btn-lg">Ver todos os produtos</a>
                </div>
            @endif

        </div>
    </section>

@endsection