<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    protected $fillable = [
        'user_id',
        'report_message',
        'week_number',
        'year',
        'monday_4',
        'monday_2',
        'tuesday_4',
        'tuesday_2',
        'wednesday_4',
        'wednesday_2',
        'thursday_4',
        'thursday_2',
        'friday_4',
        'friday_2',
        'extra'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
