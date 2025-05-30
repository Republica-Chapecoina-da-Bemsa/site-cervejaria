<form action="{{ isset($event) ? route('events.update', $event->id) : route('events.store') }}" method="POST">
    @csrf
    @if(isset($event))
    @method('PUT')
    @endif

    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $event->name ?? '') }}" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <input type="description" name="description" id="description"
            value="{{ old('description', $event->description ?? '') }}" required>
    </div>

    <div>
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" value="{{ old('location', $event->location ?? '') }}" required>
    </div>
    <div>
        <label for="date">Date:</label>
        <input type="datetime-local" name="date" id="date" value="{{ old('date', $event->date ?? '') }}" required>
    </div>
    <button type="submit">
        {{ isset($event) ? 'Update event' : 'Create event' }}
    </button>
</form>