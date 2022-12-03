<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * Relations
 * @property Collection $articles
 * @property Collection $news
 *
 * @mixin IdeHelperTag
 */
class Tag extends Model
{
    use HasFactory;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'name',
    ];

    /**
     * {@inheritdoc}
     */
    public function getRouteKeyName(): string
    {
        return 'name';
    }

    /**
     * @return MorphToMany
     */
    public function articles(): MorphToMany
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    /**
     * @return MorphToMany
     */
    public function news(): MorphToMany
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    /**
     * @return Collection
     */
    public static function cloud(): Collection
    {
        return self::has('articles')->get();
    }
}
