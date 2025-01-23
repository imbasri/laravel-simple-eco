<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail</title>
</head>

<body>
    <p>ID : {{ $order->id }}</p>
    <p>User : {{ $order->user->name }}</p>
    @foreach ($order->transactions as $t)
        <img src="{{ url('/storage/images/' . $t->product->image) }}" alt="product_image" width="100" height="100">
        <p>Product : {{ $t->product->name }}</p>
        <p>Amount : {{ $t->amount }}</p>
        <p>Total : Rp.{{ $t->amount * $t->product->price }}</p>
    @endforeach
</body>

</html>
