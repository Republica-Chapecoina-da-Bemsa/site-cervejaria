<div class="container">
    <h1>events List</h1>
    <a href="{{ route("events.create")}}">New</a>
    <form action="{{route("events.search")}}" method="get">
        <div>
            <label for="value">Search:</label>
            <input type="text" name="value" id="value">
        </div>
        <div>
            <select name="column" id="column">
                <option value="name">Name</option>
                <option value="location">Location</option>
            </select>
        </div>
        <button type="submit">Buscar</button>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Date</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $event->name }}</td>
                <td>{{ $event->description }}</td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->date }}</td>
                <td>
                     @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" width="100">
                        @else
                            No image
                        @endif
                </td>
                <td>
                    <form action="{{route("events.destroy", $event)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Deletar</button>
                    </form>
                    <a href="{{route("events.edit", $event)}}">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
