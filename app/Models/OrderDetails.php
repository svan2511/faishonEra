<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    public function orderattributes()
    {
        return $this->belongsTo(Order::class,'order_id','order_id');
    }
}
