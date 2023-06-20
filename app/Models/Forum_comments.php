<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum_comments extends Model
{
    use HasFactory;

    protected $table = 'forum_comments';

    protected $fillable = [
        'forum_id',
        'user_id',
        'post_id',
        'content'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }


}
