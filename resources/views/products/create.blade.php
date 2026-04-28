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
            background: green;
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

        <h2>Create Product</h2>

        <form action="{{ route('products.store') }}" method="POST">

            @csrf

            <!-- Name -->
            <label>Product Name</label>
            <input type="text" name="name" placeholder="Enter product name" required>

            <!-- Price -->
            <label>Price</label>
            <input type="number" name="price" placeholder="Enter price" required>

            <!-- Type -->
            <label>Product Type</label>
            <select name="type" required>
                <option value="">Select Type</option>
                <option value="physical">Physical Product</option>
                <option value="digital">Digital Product</option>
            </select>

            <!-- NEW: Status -->
            <label>Status</label>
            <select name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>

            <button type="submit">Save Product</button>

        </form>

    </div>

</body>

</html>