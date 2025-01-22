<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Product</title>
</head>

<body>
    <div style="display:flex; align-items:center; gap: 20px;">
        @foreach ($products as $product)
            <div>
                <p>{{ $product->name }}</p>
                <img src="{{ url('/storage/images/' . $product->image) }}" alt="product_image" width="100"
                    height="100">

                <form action="{{ route('show_product', $product) }}" method="get">
                    <button>Show</button>
                </form>
            </div>
        @endforeach
    </div>
</body>

</html>
