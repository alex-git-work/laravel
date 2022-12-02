<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property int $taggable_type
 * @property int $taggable_id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * Relations
 * @property Article|News $taggable
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
     * @return BelongsToMany
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }

    /**
     * @return MorphTo
     */
    public function taggable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return Collection
     */
    public static function cloud(): Collection
    {
        return self::has('articles')->get();
    }
}
