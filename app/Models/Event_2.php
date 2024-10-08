<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_2 extends Model
{
    use HasFactory;
    protected $table = 'events_2'; // Nombre de la tabla en la base de datos

    protected $fillable = ['event', 'description', 'start_date', 'end_date'];

    /**
     * Define la relación entre Event y User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
