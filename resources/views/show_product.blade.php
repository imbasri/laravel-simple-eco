<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
</head>

<body>

    <a href="{{ route('index_product') }}">Back</a>
    <p>Name: {{ $product->name }}</p>
    <p>Description: {{ $product->description }}</p>
    <p>Price: Rp.{{ $product->price }}</p>
    <p>Stock: {{ $product->stock }}</p>
    <img src="{{ url('/storage/images/' . $product->image) }}" alt="product_image" width="100" height="100">
    <form action="{{ route('edit_product', $product) }}" method="get">
        @csrf
        <button>Edit</button>
    </form>

    <form action="{{ route('add_to_cart', $product) }}" method="post">
        @csrf
        <input type="number" name="amount" id="amount" value="1">
        <button>Add to Cart</button>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif
    </form>
</body>

</html>
