<?php

namespace App\Services;

use App\Models\Interfaces\Synchronizer;
use App\Models\Tag;
use Illuminate\Support\Collection;

/**
 * Class TagsSynchronizer
 * @package App\Services
 */
class TagsSynchronizer
{
    /**
     * @param Collection $tags
     * @param Synchronizer $model
     * @return void
     */
    public function sync(Collection $tags, Synchronizer $model): void
    {
        /** @var Collection $currentTags */
        $currentTags = $model->tags->keyBy('name');
        $newTags = $tags->keyBy(fn ($value) => $value);

        $ids = $currentTags->intersectByKeys($newTags)->pluck('id')->toArray();
        $tagsToAttach = $newTags->diffKeys($currentTags);

        foreach ($tagsToAttach as $tag) {
            /** @var Tag $tag */
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $ids[] = $tag->id;
        }

        $model->tags()->sync($ids);
    }
}
