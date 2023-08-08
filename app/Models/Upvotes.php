<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upvotes extends Model
{
    use HasFactory;
    protected $table = 'upvotes';
    public $timestamps = false;
    protected $fillable = [
        'post_id',
        'user_id'
    ];
}
