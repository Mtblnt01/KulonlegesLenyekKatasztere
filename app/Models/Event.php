<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'creature_id',
        'name',
        'description',
        'event_date',
        'location',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public function creature(): BelongsTo
    {
        return $this->belongsTo(Creature::class);
    }
}
