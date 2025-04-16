<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    use HasFactory;
    function getProduct()
    {
        return $this->hasMany('App\Models\M_products');
    }
}
