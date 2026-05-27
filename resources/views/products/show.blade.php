<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
        }

        .info-box {
            background: #fafafa;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 3px;
            margin-bottom: 20px;
        }

        .info-row {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
            color: #555;
        }

        .info-value {
            display: inline-block;
            color: #333;
        }

        .status-active {
            color: #4caf50;
            font-weight: bold;
        }

        .status-inactive {
            color: #f44336;
            font-weight: bold;
        }

        .type-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }

        .type-physical {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .type-digital {
            background: #e3f2fd;
            color: #1565c0;
        }

        .btn-back {
            display: inline-block;
            background: #4caf50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 14px;
        }

        .btn-back:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Product Details</h2>

        <div class="info-box">
            <div class="info-row">
                <span class="info-label">ID:</span>
                <span class="info-value">{{ $product->id }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">Name:</span>
                <span class="info-value">{{ $product->name }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">Price:</span>
                <span class="info-value">${{ number_format($product->price, 2) }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">Type:</span>
                <span class="info-value">
                    <span class="type-badge {{ $product->type == 'physical' ? 'type-physical' : 'type-digital' }}">
                        {{ $product->type == 'physical' ? 'Physical Product' : 'Digital Product' }}
                    </span>
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="info-value {{ $product->status == 'active' ? 'status-active' : 'status-inactive' }}">
                    {{ ucfirst($product->status) }}
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">Created:</span>
                <span class="info-value">{{ $product->created_at->format('Y-m-d H:i:s') }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">Last Updated:</span>
                <span class="info-value">{{ $product->updated_at->format('Y-m-d H:i:s') }}</span>
            </div>
        </div>

        <a href="{{ route('products.index') }}" class="btn-back">Back to List</a>
    </div>
</body>
</html>