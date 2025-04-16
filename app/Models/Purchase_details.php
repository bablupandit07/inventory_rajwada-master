<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_details extends Model
{
    // use HasFactory;
    protected $table = 'purchase_details';
    protected $fillable = ['product_id', 'unit_id', 'rate', 'qty', 'total'];
}
