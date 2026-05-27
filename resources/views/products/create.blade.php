<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 500px;
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

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
            font-size: 13px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 3px;
            font-size: 14px;
        }

        button {
            background: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
            width: 100%;
        }

        button:hover {
            background: #45a049;
        }

        .btn-back {
            display: inline-block;
            margin-top: 10px;
            text-align: center;
            background: #999;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
        }

        .btn-back:hover {
            background: #777;
        }

        .error {
            color: #f44336;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create New Product</h2>

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Product Name *</label>
                <input type="text" name="name" placeholder="Enter product name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Price *</label>
                <input type="number" name="price" placeholder="Enter price" step="0.01" value="{{ old('price') }}" required>
                @error('price')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Product Type *</label>
                <select name="type" required>
                    <option value="">Select Type</option>
                    <option value="physical" {{ old('type') == 'physical' ? 'selected' : '' }}>Physical Product</option>
                    <option value="digital" {{ old('type') == 'digital' ? 'selected' : '' }}>Digital Product</option>
                </select>
                @error('type')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Status *</label>
                <select name="status" required>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Save Product</button>
        </form>

        <a href="{{ route('products.index') }}" class="btn-back">Back to List</a>
    </div>
</body>
</html>