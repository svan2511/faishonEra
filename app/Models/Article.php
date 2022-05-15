<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Article extends Model
{
    protected $primaryKey = 'a_id';
    public $fillable = ['title' ,'body'];
    use HasFactory;

    public function comment()
    {
       return $this->morphMany(Comment::class,'commentable');
    }
}
