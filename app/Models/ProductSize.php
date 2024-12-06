<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSize extends Model
{
    /** @use HasFactory<\Database\Factories\ProductSizeFactory> */
    use HasFactory;

    protected $table = 'product_sizes';
}
