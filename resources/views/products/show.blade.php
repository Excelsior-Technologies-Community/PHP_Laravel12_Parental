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
            border-radius: 5px;
        }

        .row {
            margin-bottom: 12px;
            font-size: 18px;
        }

        .btn {
            padding: 8px 15px;
            color: white;
            text-decoration: none;
            background: green;
            display: inline-block;
            margin-top: 10px;
        }

        /* status styles */
        .status-active {
            color: green;
            font-weight: bold;
        }

        .status-inactive {
            color: red;
            font-weight: bold;
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

        <!-- FIXED TYPE DISPLAY -->
        <div class="row">
            <strong>Type:</strong> {{ $product->type }}
        </div>

        <!-- NEW STATUS FIELD -->
        <div class="row">
            <strong>Status:</strong>
            <span class="{{ $product->status == 'active' ? 'status-active' : 'status-inactive' }}">
                {{ ucfirst($product->status) }}
            </span>
        </div>

        <br>

        <a href="{{ route('products.index') }}" class="btn">Back</a>

    </div>

</body>

</html>