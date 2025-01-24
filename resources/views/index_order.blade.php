<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
</head>

<body>
    @foreach ($order as $o)
        <p>ID: {{ $o->id }}</p>
        <p>User: {{ $o->user->name }}</p>
        <p>Ordered At: {{ $o->created_at }}</p>
        <p>
            @if ($o->is_paid == true)
                <span style="color: green">Paid</span>
            @else
                @if ($o->payment_receipt)
                    <a href="{{ url('storage/payment/' . $o->payment_receipt) }}">Show Payment Receipt</a> <br>
                @endif
                <span style="color: red">Unpaid</span>
                <form action="{{ route('confirm_payment', $o) }}" method="post">
                    @csrf
                    <button type="submit">Confirm</button>
                </form>
            @endif
        </p>
    @endforeach
</body>

</html>
