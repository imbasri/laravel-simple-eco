<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>

<body>
    <div style="display:flex; align-items:center; gap: 20px;">
        @foreach ($carts as $cart)
            <div>
                <img src="{{ url('/storage/images/' . $cart->product->image) }}" alt="image_cart" width="100"
                    height="100" />
                <p>Name : {{ $cart->product->name }}</p>
                <p>Amount : {{ $cart->amount }}</p>
                <p>Price : {{ $cart->product->price }}</p>
                <p>Total : {{ $cart->amount * $cart->product->price }}</p>
            </div>
        @endforeach
    </div>

    <form action="{{ route('index_product') }}" method="get">
        @csrf
        <button type="submit">Back</button>
    </form>
</body>

</html>
