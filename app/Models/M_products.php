<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_products extends Model
{
    protected $table = 'm_product';

    use HasFactory;

    // function Getunit()
    // {
    //     return  $this->hasMany('App\Models\Units');
    // }
}
