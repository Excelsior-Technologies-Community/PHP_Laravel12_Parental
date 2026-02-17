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
