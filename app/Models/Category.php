<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = "cat_id";

    public function subCategory()
    {
        return $this->hasMany(SubCategory::class,'parent_cat_id','cat_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class,'product_cat_id','cat_id');
    }

    // public function post()
    // {
    //     // first: Model Name . Second: pivot table , third: foreigid wrt current model, fourth:foreigid wrt first argument model
    //     return $this->belongsToMany(Post::class,'category_post','cat_id','post_id');
    // }
}
