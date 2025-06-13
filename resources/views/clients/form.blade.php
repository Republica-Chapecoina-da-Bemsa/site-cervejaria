@extends('baseadm')
@section('titulo', isset($style) ? 'Editar Estilo' : 'Criar Estilo')

@section('conteudo')
<div class="container">
    <h1 class="mt-4">{{ isset($client) ? 'Editar Cliente' : 'Criar Cliente' }}</h1>

    <form action="{{ isset($client) ? route('clients.update', $client->id) : route('clients.store') }}" method="POST">
        @csrf
        @if(isset($client))
        @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $client->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $client->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telefone:</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $client->phone ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Endereço:</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $client->address ?? '') }}">
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($client) ? 'Atualizar Cliente' : 'Criar Cliente' }}
        </button>
    </form>
</div>
@endsection