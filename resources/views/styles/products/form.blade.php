<form
    action="{{ isset($product) ? route('styles.products.update', [$style->id, $product->id]) : route('styles.products.store', [$style->id]) }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($product))
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
    <input type="hidden" name="style_id" value="{{ $style->id }}">
    <button type="submit">
        {{ isset($product) ? 'Update product' : 'Create product' }}
    </button>
</form>
