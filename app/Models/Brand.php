<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $primaryKey = "brand_id";

    public function product()
    {
        return $this->hasMany(Product::class,'product_brand','brand_id');
    }
}
