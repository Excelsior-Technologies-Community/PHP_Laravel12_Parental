<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        :root {
            --bg-color: #f4f4f4;
            --container-bg: white;
            --text-color: black;
            --border-color: black;
            --input-bg: white;
        }

        body.dark {
            --bg-color: #222;
            --container-bg: #333;
            --text-color: #eee;
            --border-color: #555;
            --input-bg: #444;
        }

        body {
            font-family: Arial;
            background: var(--bg-color);
            color: var(--text-color);
            transition: 0.3s;
        }

        .container {
            width: 800px;
            margin: 50px auto;
            background: var(--container-bg);
            padding: 20px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid var(--border-color);
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
            display: inline-block;
            border-radius: 4px;
        }

        .add { background: green; }
        .edit { background: blue; }
        .delete { background: red; }

        .search-box {
            margin-bottom: 15px;
            display: flex;
            gap: 10px;
        }

        .search-box input {
            padding: 8px;
            width: 60%;
            background: var(--input-bg);
            color: var(--text-color);
            border: 1px solid var(--border-color);
            border-radius: 4px;
        }

        .search-box button {
            padding: 8px 12px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
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

        <h2>Product List</h2>

        <form method="GET" class="search-box">
            <input type="text" name="search" placeholder="Search product name or type..." value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>

        <a href="{{ route('products.create') }}" class="btn add">Add Product</a>

        <br><br>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->type ?? class_basename($product) }}</td>
                <td>
                    <span class="{{ $product->status == 'active' ? 'status-active' : 'status-inactive' }}">
                        {{ ucfirst($product->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn add">Show</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn edit">Edit</a>
                    <a href="{{ route('products.delete', $product->id) }}" class="btn delete" onclick="return confirm('Are You Sure Delete This?')">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    <script>
        function toggleTheme() {
            document.body.classList.toggle('dark');
        }
    </script>

</body>
</html>