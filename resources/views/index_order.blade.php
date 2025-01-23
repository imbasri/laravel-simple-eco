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
    @endforeach
</body>

</html>
