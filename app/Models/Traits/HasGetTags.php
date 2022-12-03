<?php

namespace App\Models\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Trait HasGetTags
 * @package AApp\Models\Traits
 */
trait HasGetTags
{
    /**
     * @param bool $asArray
     * @return array|Collection
     */
    public function getTags(bool $asArray = false): array|Collection
    {
        if ($this->input('tags') === null) {
            return $asArray ? [] : collect();
        }

        $tags = Arr::map(explode(',', $this->input('tags')), fn ($value) => trim($value));

        return $asArray ? $tags : collect($tags);
    }
}
