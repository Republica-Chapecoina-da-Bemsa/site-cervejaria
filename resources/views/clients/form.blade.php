<form action="{{ isset($client) ? route('clients.update', $client->id) : route('clients.store') }}" method="POST">
    @csrf
    @if(isset($client))
        @method('PUT')
    @endif

    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $client->name ?? '') }}" required>
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email', $client->email ?? '') }}" required>
    </div>

    <div>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone', $client->phone ?? '') }}">
    </div>
    <div>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="{{ old('address', $client->address ?? '') }}">
    </div>
    <button type="submit">
        {{ isset($client) ? 'Update Client' : 'Create Client' }}
    </button>
</form>
