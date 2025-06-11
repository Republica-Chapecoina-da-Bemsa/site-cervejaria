@extends ('base')

@section('titulo', 'Home')
@section('conteudo')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Bem-vindo</h2>
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Clientes</h5>
                    <a href="{{ route('clients.list')}}" class="btn btn-primary">Ver Clientes</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <h2 class="mb-4 text-center">Bem-vindo</h2>
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Clientes</h5>
                    <a href="{{ route('clients.list')}}" class="btn btn-primary">Ver Clientes</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
