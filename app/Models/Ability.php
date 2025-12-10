<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ability extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'power_level',
    ];

    protected $casts = [
        'power_level' => 'integer',
    ];

    /**
     * Creatures that possess this ability
     */
    public function creatures(): BelongsToMany
    {
        return $this->belongsToMany(Creature::class);
    }
}
