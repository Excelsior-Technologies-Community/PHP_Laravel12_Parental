# PHP_Laravel12_Parental


## Project Description

PHP_Laravel12_Parental is a Laravel 12 based web application that demonstrates how to use the Parental package to implement Single Table Inheritance (STI) in Laravel.

Single Table Inheritance allows multiple related models to be stored in a single database table while behaving like separate model types in the application.

In this project, we create a Product management system where different types of products such as Physical Products and Digital Products are stored in the same products table but handled using separate child models.


## Purpose of the Project

The main purpose of this project is to demonstrate:

• How to install and configure the Parental package in Laravel 12
• How to create parent and child models
• How to store multiple model types in a single database table
• How to automatically retrieve correct child model using type column
• How to perform CRUD operations using Single Table Inheritance


## Features

• Laravel 12 project setup
• Parental package integration
• Single Table Inheritance implementation
• Create Physical and Digital Products
• View all products
• View single product details
• Edit product
• Delete product
• Simple UI without layout extend


## Technologies Used

• Laravel 12
• PHP 8+
• MySQL
• Parental Package
• Blade Template Engine



## How It Works

This project uses the Parental package to implement Single Table Inheritance (STI).

There is one parent model (Product) and two child models (PhysicalProduct, DigitalProduct).

All product data is stored in a single table called products.

The type column stores the product type:

physical → PhysicalProduct model  
digital → DigitalProduct model  

When retrieving records, Laravel automatically loads the correct child model based on the type column.


---



## Installation Steps


---


## STEP 1: Create Laravel 12 Project

### Open terminal / CMD and run:

```
composer create-project laravel/laravel PHP_Laravel12_Parental "12.*"

```

### Go inside project:

```
cd PHP_Laravel12_Parental

```

#### Explanation:

This command installs Laravel 12 and creates a new project folder with all required Laravel files and dependencies.

This command moves into the project directory so you can run Laravel commands.



## STEP 2: Database Setup 

### Open .env and set:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel12_Parental
DB_USERNAME=root
DB_PASSWORD=

```

### Create database in MySQL / phpMyAdmin:

```
Database name: laravel12_Parental

```

#### Explanation:

This connects your Laravel project to the MySQL database.




## STEP 3: Install Parental Package

### Run:

```
composer require tightenco/parental

```

#### Explanation:

This installs the Parental package, which allows multiple child models using a single database table.




## STEP 4: Create Product Model + Migration

### Run command:

```
php artisan make:model Product -m

```

### Open: database/migrations/xxxx_create_products_table.php

```
<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table)
        {
            $table->id();

            $table->string('name');

            $table->integer('price');

            $table->string('type')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

```

### Run migration:

```
php artisan migrate

```

#### Explanation:

This creates a Product model and migration file for the products table.

This creates columns to store product name, price, and type (physical or digital).

This creates the products table in the database.






## STEP 5: Create Child Models

### Run commands:

```
php artisan make:model PhysicalProduct

php artisan make:model DigitalProduct

```

#### Explanation:

These models represent different product types stored in the same table.





## STEP 6: Edit Parent Model

### Open: app/Models/Product.php

```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PhysicalProduct;
use App\Models\DigitalProduct;

use Parental\HasChildren;

class Product extends Model
{
    use HasChildren;

    protected $fillable =
        [
            'name',
            'price',
            'type'
        ];
    protected $childTypes =
        [
            'physical' => PhysicalProduct::class,
            'digital' => DigitalProduct::class,
        ];
}

```

#### Explanation:

This defines the main Product model and connects child models using the type column.





## STEP 7: Edit PhysicalProduct Model

### Open: app/Models/PhysicalProduct.php

```
<?php

namespace App\Models;

use Parental\HasParent;

class PhysicalProduct extends Product
{
    use HasParent;

    protected $fillable = ['name', 'price'];

    public function getType()
    {
        return "Physical Product";
    }
}


```

#### Explanation:

This model represents physical products and inherits from Product model.




## STEP 8: Edit DigitalProduct Model

### Open: app/Models/DigitalProduct.php

```
<?php

namespace App\Models;

use Parental\HasParent;

class DigitalProduct extends Product
{
    use HasParent;

    protected $fillable = ['name', 'price'];

    public function getType()
    {
        return "Digital Product";
    }
}


```

#### Explanation:

This model represents digital products and inherits from Product model.





## STEP 9: Create Controller

### Run command:

```
php artisan make:controller ProductController

```

### Open: app/Http/Controllers/ProductController.php

```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PhysicalProduct;
use App\Models\DigitalProduct;

class ProductController extends Controller
{

    // Show all products
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }


    // Show create form
    public function create()
    {
        return view('products.create');
    }


    // Store product
    public function store(Request $request)
    {

        if ($request->type == 'physical') {
            PhysicalProduct::create([
                'name' => $request->name,
                'price' => $request->price,
            ]);
        } else {
            DigitalProduct::create([
                'name' => $request->name,
                'price' => $request->price,
            ]);
        }

        return redirect()->route('products.index');

    }

    // Show single product
    public function show($id)
    {
        $product = Product::find($id);

        return view('products.show', compact('product'));
    }


    // Edit form
    public function edit($id)
    {
        $product = Product::find($id);

        return view('products.edit', compact('product'));
    }


    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->name = $request->name;
        $product->price = $request->price;

        $product->save();

        return redirect()->route('products.index');
    }


    // Delete product
    public function delete($id)
    {
        Product::find($id)->delete();

        return redirect()->route('products.index');
    }

}

```

#### Explanation:

This creates a controller to handle product create, read, update, and delete operations.





## STEP 10: Add Routes

### Open: routes/web.php

```
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('/create', [ProductController::class, 'create'])->name('products.create');

Route::post('/store', [ProductController::class, 'store'])->name('products.store');

Route::get('/show/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');

Route::post('/update/{id}', [ProductController::class, 'update'])->name('products.update');

Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');

```

#### Explanation:

Routes connect browser URLs to controller functions.




## STEP 11: Create Views Folder

### Create folder:

```
resources/views/products

```


### resources/views/products/index.blade.php

```
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
    width: 700px;
    margin: 50px auto;
    background: white;
    padding: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
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

</style>

</head>

<body>

<div class="container">

<h2>Product List</h2>

<a href="{{ route('products.create') }}" class="btn add">Add Product</a>

<br><br>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Type</th>
<th>Action</th>
</tr>

@foreach($products as $product)

<tr>

<td>{{ $product->id }}</td>

<td>{{ $product->name }}</td>

<td>{{ $product->price }}</td>

<td>{{ class_basename($product) }}</td>

<td>

<a href="{{ route('products.show', $product->id) }}" class="btn add">
Show
</a>

<a href="{{ route('products.edit', $product->id) }}" class="btn edit">
Edit
</a>

<a href="{{ route('products.delete', $product->id) }}" class="btn delete" onclick="return confirm('Are You Sure Delete This?')">
Delete
</a>

</td>


</tr>

@endforeach

</table>

</div>

</body>
</html>

```


### resources/views/products/create.blade.php

```
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
    width: 400px;
    margin: 50px auto;
    background: white;
    padding: 20px;
}

input, select {
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
}

</style>

</head>

<body>

<div class="container">

<h2>Create Product</h2>

<form action="{{ route('products.store') }}" method="POST">

@csrf

<input type="text" name="name" placeholder="Name" required>

<input type="number" name="price" placeholder="Price" required>

<select name="type" required>

<option value="">Select Type</option>

<option value="physical">Physical Product</option>

<option value="digital">Digital Product</option>

</select>

<br><br>

<button type="submit">Save</button>

</form>

</div>

</body>
</html>

```


### resources/views/products/edit.blade.php

```
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
    width: 400px;
    margin: 50px auto;
    background: white;
    padding: 20px;
}

input {
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
}

</style>

</head>

<body>

<div class="container">

<h2>Edit Product</h2>

<form action="{{ route('products.update', $product->id) }}" method="POST">

@csrf

<input type="text" name="name" value="{{ $product->name }}" required>

<input type="number" name="price" value="{{ $product->price }}" required>

<br><br>

<button type="submit">Update</button>

</form>

</div>

</body>
</html>

```


### resources/views/products/show.blade.php

```
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
}

.row {
    margin-bottom: 10px;
    font-size: 18px;
}

.btn {
    padding: 8px 15px;
    color: white;
    text-decoration: none;
    background: green;
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

<div class="row">
    <strong>Type:</strong> {{ class_basename($product) }}
</div>

<br>

<a href="{{ route('products.index') }}" class="btn">Back</a>

</div>

</body>
</html>

```



## STEP 12: Launch the Server

### Run:

```
php artisan serve

```
### Then open your browser:

```
http://localhost:8000

```

#### Explanation:

Starts Laravel development server.

This opens your Laravel project in the browser.




## So you can see this type Output:


### Product (Main) Page:


<img width="1913" height="940" alt="Screenshot 2026-02-17 124433" src="https://github.com/user-attachments/assets/c918f0b2-27aa-4d0d-913b-c3835e82cac8" />


### Product Create Page:


<img width="1919" height="915" alt="Screenshot 2026-02-17 124614" src="https://github.com/user-attachments/assets/5adf4140-7d55-4993-b236-aba1e35d61fd" />

<img width="1919" height="893" alt="Screenshot 2026-02-17 124623" src="https://github.com/user-attachments/assets/e0aefcf1-c05e-45da-9e10-c39df3b4f234" />


### Product Show Page:


<img width="1912" height="876" alt="Screenshot 2026-02-17 124630" src="https://github.com/user-attachments/assets/6f9a77d7-c325-4311-93e0-1791a1fed89d" />


### Product Edit Page:


<img width="1919" height="936" alt="Screenshot 2026-02-17 124648" src="https://github.com/user-attachments/assets/14c96a31-a1ee-4d7c-8756-b33417ac7fcd" />

<img width="1919" height="868" alt="Screenshot 2026-02-17 124923" src="https://github.com/user-attachments/assets/f21ba3c4-f9d4-4adf-8c16-b909d94a1540" />


### Product Delete Page:


<img width="1919" height="864" alt="Screenshot 2026-02-17 125003" src="https://github.com/user-attachments/assets/d1cb1533-749c-43b4-94ec-602c4ea690ff" />



---


# Project Folder Structure:

``` 
PHP_Laravel12_Parental/
│
├── app/
│   │
│   ├── Http/
│   │   └── Controllers/
│   │       └── ProductController.php
│   │
│   ├── Models/
│   │   ├── Product.php
│   │   ├── PhysicalProduct.php
│   │   └── DigitalProduct.php
│   │
│   └── Providers/
│
├── bootstrap/
│
├── config/
│
├── database/
│   │
│   ├── factories/
│   │
│   ├── migrations/
│   │   └── xxxx_xx_xx_create_products_table.php
│   │
│   └── seeders/
│
├── public/
│   └── index.php
│
├── resources/
│   │
│   ├── views/
│   │   └── products/
│   │       ├── index.blade.php
│   │       ├── create.blade.php
│   │       ├── edit.blade.php
│   │       └── show.blade.php
│   │
│   ├── css/
│   ├── js/
│   └── images/
│
├── routes/
│   └── web.php
│
├── storage/
│
├── tests/
│
├── vendor/
│
├── .env
├── artisan
├── composer.json
├── composer.lock
└── package.json

```
