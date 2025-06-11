@extends('base')

<div class="container">
    <h1 class="mt-4">{{ isset($style) ? 'Editar Estilo' : 'Criar Estilo' }}</h1>

    <form action="{{ isset($style) ? route('styles.update', $style->id) : route('styles.store') }}" method="POST">
        @csrf
        @if(isset($style))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $style->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição:</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $style->description ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($style) ? 'Atualizar Estilo' : 'Criar Estilo' }}
        </button>
    </form>
</div>
