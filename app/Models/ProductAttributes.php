<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    use HasFactory;

    protected $primaryKey = "attr_id";

    public function subCategory()
    {
        return $this->belongsTo(Product::class,'product_id','product_id');
    }
    
    
}
