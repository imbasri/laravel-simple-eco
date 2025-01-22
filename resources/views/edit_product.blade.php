<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - {{ $product->name }}</title>
</head>

<body>
    <form action="{{ route('update_product', $product) }}" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <label for="name">Name:</label> <br>
        <input type="text" name="name" id="name" value="{{ $product->name }}"> <br>
        <label for="description">Description:</label> <br>
        <textarea type="text" name="description" id="description">{{ $product->description }}</textarea> <br>
        <label for="price">Price:</label> <br>
        <input type="number" name="price" id="price" value="{{ $product->price }}"> <br>
        <label for="stock">Stock:</label> <br>
        <input type="number" name="stock" id="stock" value="{{ $product->stock }}"> <br>
        <label for="image">Image:</label> <br>
        <input type="file" name="image" id="image"><br>

        <button type="submit">Update Product</button>

    </form>
</body>

</html>
