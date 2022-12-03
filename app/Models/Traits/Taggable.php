<?php

namespace App\Models\Traits;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\morphToMany;

/**
 * Trait Taggable
 * @package AApp\Models\Traits
 */
trait Taggable
{
    /**
     * Get the entity's tags.
     *
     * @return morphToMany
     */
    public function tags(): morphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
