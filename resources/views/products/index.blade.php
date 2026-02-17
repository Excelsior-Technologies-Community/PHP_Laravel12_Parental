<!DOCTYPE html>
<html>
<head>

<title>Product List</title>

<style>

body {
    font-family: Arial;
    background: #f4f4f4;
}

.container {
    width: 700px;
    margin: 50px auto;
    background: white;
    padding: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
}

th, td {
    padding: 10px;
    text-align: center;
}

.btn {
    padding: 5px 10px;
    color: white;
    text-decoration: none;
    margin: 2px;
}

.add {
    background: green;
}

.edit {
    background: blue;
}

.delete {
    background: red;
}

</style>

</head>

<body>

<div class="container">

<h2>Product List</h2>

<a href="{{ route('products.create') }}" class="btn add">Add Product</a>

<br><br>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Type</th>
<th>Action</th>
</tr>

@foreach($products as $product)

<tr>

<td>{{ $product->id }}</td>

<td>{{ $product->name }}</td>

<td>{{ $product->price }}</td>

<td>{{ class_basename($product) }}</td>

<td>

<a href="{{ route('products.show', $product->id) }}" class="btn add">
Show
</a>

<a href="{{ route('products.edit', $product->id) }}" class="btn edit">
Edit
</a>

<a href="{{ route('products.delete', $product->id) }}" class="btn delete" onclick="return confirm('Are You Sure Delete This?')">
Delete
</a>

</td>


</tr>

@endforeach

</table>

</div>

</body>
</html>
