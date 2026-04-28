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
            width: 420px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
        }

        input,
        select {
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
            margin-top: 15px;
            cursor: pointer;
        }

        label {
            margin-top: 10px;
            display: block;
            font-weight: bold;
        }
    </style>

</head>

<body>

    <div class="container">

        <h2>Edit Product</h2>

        <form action="{{ route('products.update', $product->id) }}" method="POST">

            @csrf

            <!-- Name -->
            <label>Product Name</label>
            <input type="text" name="name" value="{{ $product->name }}" required>

            <!-- Price -->
            <label>Price</label>
            <input type="number" name="price" value="{{ $product->price }}" required>

            <!-- Type -->
            <label>Product Type</label>
            <select name="type">
                <option value="physical" {{ $product->type == 'physical' ? 'selected' : '' }}>
                    Physical Product
                </option>
                <option value="digital" {{ $product->type == 'digital' ? 'selected' : '' }}>
                    Digital Product
                </option>
            </select>

            <!-- Status -->
            <label>Status</label>
            <select name="status">
                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>
                    Active
                </option>
                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>

            <button type="submit">Update Product</button>

        </form>

    </div>

</body>

</html>