<!DOCTYPE html>
<html>
<head>

<title>Show Product</title>

<style>

body {
    font-family: Arial;
    background: #f4f4f4;
}

.container {
    width: 500px;
    margin: 50px auto;
    background: white;
    padding: 20px;
}

.row {
    margin-bottom: 10px;
    font-size: 18px;
}

.btn {
    padding: 8px 15px;
    color: white;
    text-decoration: none;
    background: green;
}

</style>

</head>

<body>

<div class="container">

<h2>Product Details</h2>

<div class="row">
    <strong>ID:</strong> {{ $product->id }}
</div>

<div class="row">
    <strong>Name:</strong> {{ $product->name }}
</div>

<div class="row">
    <strong>Price:</strong> {{ $product->price }}
</div>

<div class="row">
    <strong>Type:</strong> {{ class_basename($product) }}
</div>

<br>

<a href="{{ route('products.index') }}" class="btn">Back</a>

</div>

</body>
</html>
