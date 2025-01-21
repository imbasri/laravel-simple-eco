<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Product</title>
</head>

<body>
    @foreach ($products as $product)
        <ul>

            <li>{{ $product->name }}</li>
            <li>{{ $product->description }}</li>
            <li>{{ $product->price }}</li>
            <li>{{ $product->stock }}</li>
                <img src="{{ url('/storage/images/' . $product->image) }}" alt="product_image" width="100" height="100">
        </ul>
    @endforeach
</body>

</html>
