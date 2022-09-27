<?php

namespace App\Services;

use App\Models\Interfaces\TagsProvider;
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
     * @param TagsProvider $model
     * @return void
     */
    public function sync(Collection $tags, TagsProvider $model): void
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
