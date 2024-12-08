<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    /** @use HasFactory<\Database\Factories\ProductImageFactory> */
    use HasFactory;
    protected $table = 'product_images';

    public function getLogo(){
        if(!empty($this->image_name) && file_exists(public_path('upload/product/'.$this->image_name))){
            return asset('upload/product/'.$this->image_name);
        }
        return "";
    }
}
