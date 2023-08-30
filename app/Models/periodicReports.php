<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class periodicReports extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'answer1',
        'answer2',
        'answer3',
        'answer4',
        'answer5',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
