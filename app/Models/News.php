<?php

namespace App\Models;

use App\Models\Interfaces\TagsProvider;
use App\Models\Traits\Commentable;
use App\Models\Traits\Taggable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * Relations
 * @property Collection $tags
 * @property Collection $comments
 *
 * @mixin IdeHelperNews
 */
class News extends Model implements TagsProvider
{
    use HasFactory;
    use SoftDeletes;
    use Taggable;
    use Commentable;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'title',
        'body',
    ];

    public const MORPH_TYPE = 'news';

    public const CACHE_TAGS = [
        'news',
        'tag',
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
}
