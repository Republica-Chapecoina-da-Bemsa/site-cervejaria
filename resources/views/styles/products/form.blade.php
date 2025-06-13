@extends('baseadm')
@section('titulo', isset($style) ? 'Editar Estilo' : 'Criar Estilo')

@section('conteudo')
<div class="container">
    <h1 class="mt-4">{{ isset($product) ? 'Editar Produto' : 'Criar Produto' }}</h1>

    <form
        action="{{ isset($product) ? route('styles.products.update', [$style->id, $product->id]) : route('styles.products.store', [$style->id]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product))
        @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição:</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $product->description ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço:</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagem:</label>
            <input type="file" name="image" id="image" class="form-control">
            @if(isset($product) && $product->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100">
            </div>
            @endif
        </div>

        <input type="hidden" name="style_id" value="{{ $style->id }}">

        <button type="submit" class="btn btn-primary">
            {{ isset($product) ? 'Atualizar Produto' : 'Criar Produto' }}
        </button>
    </form>
</div>
@endsection