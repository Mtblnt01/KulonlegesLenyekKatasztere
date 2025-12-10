<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Creature extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'origin',
        'danger_level',
        'is_magical',
    ];

    protected $casts = [
        'is_magical' => 'boolean',
        'danger_level' => 'integer',
    ];

    /**
     * The user who created this creature
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The category this creature belongs to
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Abilities that this creature possesses
     */
    public function abilities(): BelongsToMany
    {
        return $this->belongsToMany(Ability::class);
    }

    /**
     * Gallery images for this creature
     */
    public function galleryImages(): HasMany
    {
        return $this->hasMany(GalleryImage::class);
    }

    /**
     * Events related to this creature
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
