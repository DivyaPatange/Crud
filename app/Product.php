<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = ['product_name', 'product_price', 'size', 'stock', 'product_description', 'category'];
}
