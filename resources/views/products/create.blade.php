<!DOCTYPE html>
<html>
<head>

<title>Create Product</title>

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

input, select {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
}

button {
    background: green;
    color: white;
    padding: 10px;
    border: none;
    width: 100%;
}

</style>

</head>

<body>

<div class="container">

<h2>Create Product</h2>

<form action="{{ route('products.store') }}" method="POST">

@csrf

<input type="text" name="name" placeholder="Name" required>

<input type="number" name="price" placeholder="Price" required>

<select name="type" required>

<option value="">Select Type</option>

<option value="physical">Physical Product</option>

<option value="digital">Digital Product</option>

</select>

<br><br>

<button type="submit">Save</button>

</form>

</div>

</body>
</html>
