@extends('baseadm')

@section('titulo', 'Bem-vindo à Dom Guri')

@section('conteudo')


<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Dom Guri</h2>
            <p class="lead text-muted">Acesso de administrador</p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <div class="col">
                <div class="card h-100 shadow-sm border-0 text-center p-3">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="mb-4">
                            <h5 class="card-title fw-bold">Clientes</h5>
                        </div>
                        <a href="{{ route('clients.index') }}" class="btn btn-outline-primary mt-auto">Ver Clientes</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-sm border-0 text-center p-3">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="mb-4">
                            <h5 class="card-title fw-bold">Cervejas</h5>
                        </div>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-success mt-auto">Ver Produtos</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-sm border-0 text-center p-3">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="mb-4">
                            <h5 class="card-title fw-bold">Estilos de Cerveja</h5>
                        </div>
                        <a href="{{ route('styles.index') }}" class="btn btn-outline-info mt-auto">Ver Estilos</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-sm border-0 text-center p-3">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="mb-4">
                            <h5 class="card-title fw-bold">Eventos</h5>
                        </div>
                        <a href="{{ route('events.index') }}" class="btn btn-outline-warning mt-auto">Ver Eventos</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-sm border-0 text-center p-3">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="mb-4">
                            <h5 class="card-title fw-bold">Recibos</h5>
                        </div>
                        <a href="{{ route('recipts.index') }}" class="btn btn-outline-warning mt-auto">Ver Recibos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection