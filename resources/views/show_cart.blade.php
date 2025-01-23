<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>

<body>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif
    <div style="display:flex; align-items:center; gap: 20px;">
        @foreach ($carts as $cart)
            <div>
                <img src="{{ url('/storage/images/' . $cart->product->image) }}" alt="image_cart" width="100"
                    height="100" />
                <p>Name : {{ $cart->product->name }}</p>
                <p>Price : {{ $cart->product->price }}</p>
                <p>Total : {{ $cart->amount * $cart->product->price }}</p>
                <form action="{{ route('update_cart', $cart) }}" method="post">
                    @method('PATCH')
                    @csrf
                    <input type="number" name="amount" id="amount" value="{{ $cart->amount }}">
                    <button>Update</button>
                </form>
            </div>
            <form action="{{ route('delete_cart', $cart) }}" method="post" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        @endforeach
    </div>

    <form action="{{ route('index_product') }}" method="get">
        @csrf
        <button type="submit">Back</button>
    </form>

    <form action="{{ route('checkout') }}" method="post">
        @csrf

        <button type="submit">Checkout</button>
    </form>
</body>

</html>
