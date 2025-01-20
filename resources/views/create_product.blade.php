<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>

<body>
    <h2>Create Product</h2>
    <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" id="name" placeholder="name"> <br>
        <textarea type="text" name="description" id="description" placeholder="description"></textarea> <br>
        <input type="number" name="price" id="price" placeholder="price"><br>
        <input type="number" name="stock" id="stock" placeholder="stock"><br>
        <input type="file" name="image" id="image"><br>

        <button type="submit">Create Product</button>
    </form>
</body>

</html>
