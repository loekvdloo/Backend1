<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <input type="text" name="productnaam" placeholder="Name" required>
    <input type="number" name="prijs">
    <button type="submit">Create Product</button>
</form>
