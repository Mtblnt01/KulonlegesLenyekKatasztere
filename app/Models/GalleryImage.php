<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryImage extends Model
{
    protected $fillable = [
        'creature_id',
        'image_path',
        'title',
        'description',
    ];

    /**
     * The creature this image belongs to
     */
    public function creature(): BelongsTo
    {
        return $this->belongsTo(Creature::class);
    }
}
