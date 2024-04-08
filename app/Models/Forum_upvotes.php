<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum_upvotes extends Model
{
    use HasFactory;

    protected $table = 'upvotes';

    protected $fillable = [
        'post_id',
        'user_id'
    ];
}
