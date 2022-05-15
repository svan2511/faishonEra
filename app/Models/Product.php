<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = "product_id";

    public function category()
    {
        return $this->belongsTo(Category::class,'product_cat_id','cat_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class,'product_brand','brand_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class,'product_sub_cat_id','subcat_id');
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttributes::class,'product_id','product_id');
    }

    

}
