<?php

namespace App\Models\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Interface Synchronizer
 * @package App\Models\Interfaces
 */
interface TagsProvider
{
    public function tags(): MorphMany;
}
