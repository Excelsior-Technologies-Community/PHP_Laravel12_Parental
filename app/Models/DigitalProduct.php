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

