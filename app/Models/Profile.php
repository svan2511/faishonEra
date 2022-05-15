<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $primaryKey = 'p_id';

    use HasFactory;
    public $fillable = ['email','phone'];

    public function profileable()
    {
        return $this->morphTo();
    }
}
