<?php

namespace App\Models;

use App\Events\ArticleCreated;
use App\Events\ArticleDestroyed;
use App\Events\ArticleUpdated;
use App\Models\Interfaces\TagsProvider;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property int $author_id
 * @property int $status
 * @property string $title
 * @property string $preview
 * @property string $body
 * @property string $slug
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * Relations
 * @property User $user
 * @property Collection $tags
 *
 * @method static Builder active
 * @method static Model create(array $attributes)
 */
class Article extends Model implements TagsProvider
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
        'updated' => ArticleUpdated::class,
        'deleted' => ArticleDestroyed::class,
    ];

    /**
     * Статусы
     */
    public const STATUS_HIDDEN = 0;
    public const STATUS_PUBLISHED = 1;

    public const STATUSES = [
        self::STATUS_HIDDEN,
        self::STATUS_PUBLISHED,
    ];

    /**
     * {@inheritdoc}
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @param Builder $query
     * @param string $direction
     * @return Builder
     */
    public function scopeActive(Builder $query, string $direction = 'desc'): Builder
    {
        return $query->whereStatus(self::STATUS_PUBLISHED)->orderBy('created_at', $direction);
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->status === self::STATUS_HIDDEN;
    }

    /**
     * @return bool
     */
    public function isNotHidden(): bool
    {
        return !$this->isHidden();
    }
}
