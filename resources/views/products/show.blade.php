<!DOCTYPE html>
<html>
<head>
    <title>Show Product</title>
    <style>
        :root {
            --bg-color: #f4f4f4;
            --container-bg: white;
            --text-color: black;
            --link-color: blue;
        }

        body.dark {
            --bg-color: #222;
            --container-bg: #333;
            --text-color: #eee;
            --link-color: #66b3ff;
        }

        body {
            font-family: Arial;
            background: var(--bg-color);
            color: var(--text-color);
            transition: 0.3s;
        }

        .container {
            width: 500px;
            margin: 50px auto;
            background: var(--container-bg);
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
            border-radius: 4px;
        }

        .status-active {
            color: #28a745;
            font-weight: bold;
        }

        .status-inactive {
            color: #dc3545;
            font-weight: bold;
        }

        a {
            color: var(--link-color);
        }

        .theme-btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            float: right;
            border-radius: 4px;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="clearfix">
            <button type="button" class="theme-btn" onclick="toggleTheme()">🌙 / ☀️</button>
        </div>

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
            <strong>Type:</strong> {{ $product->type ?? class_basename($product) }}
        </div>

        @if($product->type == 'physical')
            <div class="row">
                <strong>Weight:</strong> {{ $product->weight }} kg
            </div>
            <div class="row">
                <strong>Shipping Cost:</strong> ₹{{ $product->shipping_cost }}
            </div>
        @elseif($product->type == 'digital')
            <div class="row">
                <strong>Download Link:</strong> 
                <a href="{{ $product->download_link }}" target="_blank">{{ $product->download_link }}</a>
            </div>
            <div class="row">
                <strong>File Size:</strong> {{ $product->file_size }} MB
            </div>
        @endif

        <div class="row">
            <strong>Status:</strong>
            <span class="{{ $product->status == 'active' ? 'status-active' : 'status-inactive' }}">
                {{ ucfirst($product->status) }}
            </span>
        </div>

        <br>

        <a href="{{ route('products.index') }}" class="btn">Back</a>
    </div>

    <script>
        function toggleTheme() {
            document.body.classList.toggle('dark');
        }
    </script>

</body>
</html>