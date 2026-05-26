<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <style>
        :root {
            --bg-color: #f4f4f4;
            --container-bg: white;
            --text-color: black;
            --input-border: #ccc;
            --input-bg: white;
        }

        body.dark {
            --bg-color: #222;
            --container-bg: #333;
            --text-color: #eee;
            --input-border: #555;
            --input-bg: #444;
        }

        body {
            font-family: Arial;
            background: var(--bg-color);
            color: var(--text-color);
            transition: 0.3s;
        }

        .container {
            width: 420px;
            margin: 50px auto;
            background: var(--container-bg);
            padding: 20px;
            border-radius: 5px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            box-sizing: border-box;
            border: 1px solid var(--input-border);
            background: var(--input-bg);
            color: var(--text-color);
            border-radius: 4px;
        }

        button {
            background: green;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            margin-top: 15px;
            cursor: pointer;
            border-radius: 4px;
        }

        .theme-btn {
            background: #007bff;
            width: auto;
            float: right;
            margin-top: 0;
            padding: 8px 12px;
        }

        label {
            margin-top: 10px;
            display: block;
            font-weight: bold;
        }

        .hidden {
            display: none;
        }

        .dynamic-fields {
            background: rgba(128, 128, 128, 0.1);
            padding: 15px;
            margin-top: 15px;
            border-radius: 5px;
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

        <h2>Create Product</h2>

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <label>Product Name</label>
            <input type="text" name="name" placeholder="Enter product name" required>

            <label>Price</label>
            <input type="number" name="price" placeholder="Enter price" required>

            <label>Product Type</label>
            <select name="type" id="productType" required onchange="toggleFields()">
                <option value="">Select Type</option>
                <option value="physical">Physical Product</option>
                <option value="digital">Digital Product</option>
            </select>

            <div id="physicalFields" class="dynamic-fields hidden">
                <label>Weight (kg)</label>
                <input type="text" name="weight" placeholder="Enter weight">

                <label>Shipping Cost</label>
                <input type="number" name="shipping_cost" placeholder="Enter shipping cost">
            </div>

            <div id="digitalFields" class="dynamic-fields hidden">
                <label>Download Link</label>
                <input type="url" name="download_link" placeholder="Enter download link">

                <label>File Size (MB)</label>
                <input type="text" name="file_size" placeholder="Enter file size">
            </div>

            <label>Status</label>
            <select name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>

            <button type="submit">Save Product</button>
        </form>
    </div>

    <script>
        function toggleTheme() {
            document.body.classList.toggle('dark');
        }

        function toggleFields() {
            let type = document.getElementById('productType').value;
            let physical = document.getElementById('physicalFields');
            let digital = document.getElementById('digitalFields');

            physical.classList.add('hidden');
            digital.classList.add('hidden');

            if (type === 'physical') {
                physical.classList.remove('hidden');
            } else if (type === 'digital') {
                digital.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>