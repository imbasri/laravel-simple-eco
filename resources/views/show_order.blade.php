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

    <form action="{{ route('show_order', $order) }}" method="get">
        <button>Back</button>
    </form>

    @if ($order->is_paid == 0 && $order->payment_receipt == null)
        <form action="{{ route('submit_payment_receipt', $order) }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="payment">Upload your payment receipt</label><br>
            <input type="file" name="payment_receipt" id="payment"><br><br>
            <button type="submit">Submit Payment</button>
            @if (session('error'))
                <div class="alert alert-success">
                    {{ session('error') }}
                </div>
            @endif
        </form>
    @endif
</body>

</html>
