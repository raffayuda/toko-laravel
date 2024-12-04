<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $table = 'products';
    protected $dates = ['deleted_at'];

    public function getColor()
    {
        return $this->hasMany(ProductColor::class, 'product_id')->select('product_colors.*');
    }
}
