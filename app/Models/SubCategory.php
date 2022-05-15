<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $primaryKey = "subcat_id";

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class,'parent_cat_id','cat_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class,'product_sub_cat_id','subcat_id');
    }
}
