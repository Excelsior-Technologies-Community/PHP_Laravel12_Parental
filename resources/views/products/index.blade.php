<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
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

        /* Alert Messages */
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 3px;
            border-left: 3px solid;
        }

        .alert-success {
            background: #e8f5e9;
            border-left-color: #4caf50;
            color: #2e7d32;
        }

        /* Search and Filter */
        .filters {
            background: #fafafa;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }

        .filter-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: flex-end;
        }

        .filter-group {
            flex: 1;
            min-width: 150px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 12px;
            color: #666;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 3px;
            font-size: 14px;
        }

        button {
            padding: 8px 15px;
            background: #333;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background: #555;
        }

        .reset-btn {
            background: #999;
        }

        .reset-btn:hover {
            background: #777;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 12px;
            margin: 2px;
        }

        .btn-add {
            background: #4caf50;
            color: white;
            margin-bottom: 15px;
        }

        .btn-add:hover {
            background: #45a049;
        }

        .btn-show {
            background: #2196f3;
            color: white;
        }

        .btn-edit {
            background: #ff9800;
            color: white;
        }

        .btn-delete {
            background: #f44336;
            color: white;
        }

        .btn-status {
            background: #9e9e9e;
            color: white;
        }

        .btn-status:hover {
            background: #757575;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #fafafa;
            font-weight: bold;
            color: #555;
            border-bottom: 2px solid #ddd;
        }

        tr:hover {
            background: #f9f9f9;
        }

        /* Status Badges */
        .status-active {
            color: #4caf50;
            font-weight: bold;
        }

        .status-inactive {
            color: #f44336;
            font-weight: bold;
        }

        .type-badge {
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 11px;
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

        /* Pagination */
        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a, .pagination span {
            display: inline-block;
            padding: 5px 10px;
            margin: 0 2px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #333;
            font-size: 12px;
        }

        .pagination a:hover {
            background: #f0f0f0;
        }

        .pagination .active {
            background: #333;
            color: white;
            border-color: #333;
        }

        /* Delete Form */
        .delete-form {
            display: inline;
        }

        .delete-btn {
            background: none;
            border: none;
            color: #f44336;
            cursor: pointer;
            padding: 6px 12px;
            font-size: 12px;
        }

        .delete-btn:hover {
            background: #ffebee;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Product List</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search and Filters -->
        <div class="filters">
            <form method="GET" class="filter-form">
                <div class="filter-group">
                    <label>Search</label>
                    <input type="text" name="search" placeholder="Product name..." value="{{ request('search') }}">
                </div>
                
                <div class="filter-group">
                    <label>Product Type</label>
                    <select name="type">
                        <option value="all">All Types</option>
                        <option value="physical" {{ request('type') == 'physical' ? 'selected' : '' }}>Physical</option>
                        <option value="digital" {{ request('type') == 'digital' ? 'selected' : '' }}>Digital</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="all">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label>&nbsp;</label>
                    <button type="submit">Apply</button>
                </div>
                
                <div class="filter-group">
                    <label>&nbsp;</label>
                    <a href="{{ route('products.index') }}" class="reset-btn" style="display: inline-block; padding: 8px 15px; background: #999; color: white; text-decoration: none; border-radius: 3px;">Reset</a>
                </div>
            </form>
        </div>

        <a href="{{ route('products.create') }}" class="btn btn-add">+ Add New Product</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><strong>{{ $product->name }}</strong></td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>
                        <span class="type-badge {{ $product->type == 'physical' ? 'type-physical' : 'type-digital' }}">
                            {{ $product->type == 'physical' ? 'Physical' : 'Digital' }}
                        </span>
                    </td>
                    <td>
                        <span class="{{ $product->status == 'active' ? 'status-active' : 'status-inactive' }}">
                            {{ ucfirst($product->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-show">View</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-edit">Edit</a>
                        <a href="{{ route('products.toggleStatus', $product->id) }}" class="btn btn-status" 
                           onclick="return confirm('Change product status?')">
                            Toggle Status
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Delete this product?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px;">
                        No products found. 
                        <a href="{{ route('products.create') }}" style="color: #4caf50;">Create your first product</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</body>
</html>