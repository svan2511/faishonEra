<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poem extends Model
{
    protected $primaryKey = 'p_id';

    public $fillable = ['title' ,'body'];
    use HasFactory;

    public function comment()
    {
       return $this->morphMany(Comment::class,'commentable');
    }
}
