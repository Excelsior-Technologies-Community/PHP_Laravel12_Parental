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

