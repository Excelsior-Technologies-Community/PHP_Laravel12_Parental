<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Parental\HasChildren;

class Product extends Model
{
    use HasChildren;

    protected $fillable = [
        'name',
        'price',
        'type',
        'status'
    ];

    protected $childTypes = [
        'physical' => PhysicalProduct::class,
        'digital' => DigitalProduct::class,
    ];
}