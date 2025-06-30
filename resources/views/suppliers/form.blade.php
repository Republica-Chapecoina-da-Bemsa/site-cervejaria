@extends('baseadm')
@section('titulo', isset($supplier) ? 'Editar Fornecedor' : 'Criar Fornecedor')

@section('conteudo')
<div class="container">
    <h1 class="mt-4">{{ isset($supplier) ? 'Editar Fornecedor' : 'Criar Fornecedor' }}</h1>

    <form action="{{ isset($supplier) ? route('suppliers.update', $supplier->id) : route('suppliers.store') }}" method="POST">
        @csrf
        @if(isset($supplier))
        @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $supplier->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $supplier->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telefone:</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $supplier->phone ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Endereço:</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $supplier->address ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Cidade:</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $supplier->city ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="state" class="form-label">Estado:</label>
            <input type="text" name="state" id="state" class="form-control" value="{{ old('state', $supplier->state ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="zip_code" class="form-label">CEP:</label>
            <input type="text" name="zip_code" id="zip_code" class="form-control" value="{{ old('zip_code', $supplier->zip_code ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">País:</label>
            <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $supplier->country ?? '') }}">
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($supplier) ? 'Atualizar Fornecedor' : 'Criar Fornecedor' }}
        </button>
    </form>
</div>
@endsection
