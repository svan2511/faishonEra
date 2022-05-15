<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'c_id';
    public $fillable = ['body'];
    use HasFactory;

    public function commentable()
    {
        return $this->morphTo();
    }
}
