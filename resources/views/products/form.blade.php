<form action="{{ isset($style) ? route('products.update', $style->id) : route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($style))
    @method('PUT')
    @endif

    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <input type="description" name="description" id="description"
            value="{{ old('description', $product->description ?? '') }}" required>
    </div>
    <div>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="{{ old('price', $product->price ?? '') }}" required>
    </div>
    <div>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image">
        @if(isset($product) && $product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100">
        @endif
    </div>
    <select name="style_id" id="">
        @foreach ($styles as $style)
            <option value="{{ $style->id }}" {{ (isset($product->style) && $product->style->id == $style->id) ? 'selected' : '' }}>
                {{ $style->name }}
            </option>
        @endforeach
    </select>
    <button type="submit">
        {{ isset($product) ? 'Update product' : 'Create product' }}
    </button>
</form>
