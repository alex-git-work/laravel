<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string $commentable_type
 * @property int $commentable_id
 * @property int $author_id
 * @property string $body
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * Relations
 * @property User $user
 * @property Article|News $commentable
 *
 * @mixin IdeHelperComment
 */
class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * {@inheritdoc}
     */
    protected $with = ['user'];

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'commentable_type',
        'commentable_id',
        'author_id',
        'body',
    ];

    public const CACHE_TAGS = [
        'article',
        'news',
        'stat',
    ];

    /**
     * {@inheritdoc}
     */
    protected static function boot()
    {
        $fn = fn () => Cache::tags(self::CACHE_TAGS)->flush();

        self::created($fn);
        self::updated($fn);
        self::deleted($fn);

        parent::boot();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return MorphTo
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
