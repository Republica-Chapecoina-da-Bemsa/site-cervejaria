@extends('base')

<div class="container">
    <h1 class="mt-4">{{ isset($event) ? 'Editar Evento' : 'Criar Evento' }}</h1>

    <form action="{{ isset($event) ? route('events.update', $event->id) : route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($event))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $event->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição:</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $event->description ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Localização:</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $event->location ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Data:</label>
            <input type="datetime-local" name="date" id="date" class="form-control" value="{{ old('date', $event->date ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagem:</label>
            <input type="file" name="image" id="image" class="form-control">
            @if(isset($event) && $event->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" width="100">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($event) ? 'Atualizar Evento' : 'Criar Evento' }}
        </button>
    </form>
</div>
