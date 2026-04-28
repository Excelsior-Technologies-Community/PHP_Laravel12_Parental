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
            width: 800px;
            margin: 50px auto;
            background: white;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        .btn {
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            margin: 2px;
            display: inline-block;
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

        /* search box */
        .search-box {
            margin-bottom: 15px;
        }

        .search-box input {
            padding: 8px;
            width: 60%;
        }

        .search-box button {
            padding: 8px 12px;
            background: black;
            color: white;
            border: none;
        }

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

        <h2>Product List</h2>

        <!-- search box -->
        <form method="GET" class="search-box">
            <input type="text" name="search" placeholder="Search product name or type...">
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

                <!-- better type display -->
                <td>
                    {{ $product->type ?? class_basename($product) }}
                </td>

                <!-- status column -->
                <td>
                    <span class="{{ $product->status == 'active' ? 'status-active' : 'status-inactive' }}">
                        {{ ucfirst($product->status) }}
                    </span>
                </td>

                <td>

                    <a href="{{ route('products.show', $product->id) }}" class="btn add">
                        Show
                    </a>

                    <a href="{{ route('products.edit', $product->id) }}" class="btn edit">
                        Edit
                    </a>

                    <a href="{{ route('products.delete', $product->id) }}" class="btn delete"
                        onclick="return confirm('Are You Sure Delete This?')">
                        Delete
                    </a>

                </td>

            </tr>

            @endforeach

        </table>

    </div>

</body>

</html>