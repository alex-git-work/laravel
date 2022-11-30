<?php

namespace App\Models\Traits;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait Taggable
 * @package AApp\Models\Traits
 */
trait Taggable
{
    /**
     * Get the entity's tags.
     *
     * @return MorphMany
     */
    public function tags(): MorphMany
    {
        return $this->morphMany(Tag::class, 'taggable');
    }
}
