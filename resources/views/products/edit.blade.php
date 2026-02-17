<!DOCTYPE html>
<html>
<head>

<title>Edit Product</title>

<style>

body {
    font-family: Arial;
    background: #f4f4f4;
}

.container {
    width: 400px;
    margin: 50px auto;
    background: white;
    padding: 20px;
}

input {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
}

button {
    background: blue;
    color: white;
    padding: 10px;
    border: none;
    width: 100%;
}

</style>

</head>

<body>

<div class="container">

<h2>Edit Product</h2>

<form action="{{ route('products.update', $product->id) }}" method="POST">

@csrf

<input type="text" name="name" value="{{ $product->name }}" required>

<input type="number" name="price" value="{{ $product->price }}" required>

<br><br>

<button type="submit">Update</button>

</form>

</div>

</body>
</html>
