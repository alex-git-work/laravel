<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class TagsSynchronizer
 * @package App\Services
 */
class TagsSynchronizer
{
    /**
     * @param Collection $tags
     * @param Model $model
     * @return void
     */
    public function sync(Collection $tags, Model $model): void
    {
        if ($model instanceof Article) {
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
}
