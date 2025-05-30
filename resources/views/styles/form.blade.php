<form action="{{ isset($style) ? route('styles.update', $style->id) : route('styles.store') }}" method="POST">
    @csrf
    @if(isset($style))
    @method('PUT')
    @endif

    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $style->name ?? '') }}" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <input type="description" name="description" id="description"
            value="{{ old('description', $style->description ?? '') }}" required>
    </div>

    <button type="submit">
        {{ isset($style) ? 'Update style' : 'Create style' }}
    </button>
</form>
