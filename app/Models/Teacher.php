<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $primaryKey = 't_id';
    use HasFactory;
    public $fillable = ['f_name','l_name'];

    public function profile()
    {
        return $this->morphOne(Profile::class,'profileable');
    }
}
