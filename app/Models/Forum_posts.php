<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum_posts extends Model
{
    use HasFactory;

    protected $table = 'forum_posts';

    protected $fillable = [
        'forum_id',
        'user_id',
        'title',
        'content',
        'image_id',
        'isPinned',
        'isLocked'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function forum_comments()
    {
        return $this->hasMany(Forum_comments::class);
    }
}
