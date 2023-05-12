<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $table = 'forums';

    protected $fillable = [
        'title',
        'category',
        'upvotes',
        'hasPinned',
        'admin_id',
    ];

    public function forum_comments()
    {
        return $this->hasMany(Forum_comments::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
