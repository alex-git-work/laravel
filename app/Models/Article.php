<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $status
 * @property string $title
 * @property string $preview
 * @property string $body
 * @property string $slug
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method static Builder active
 * @method static Model create(array $attributes)
 */
class Article extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
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
     * @param Builder $query
     * @param string $direction
     * @return Builder
     */
    public function scopeActive(Builder $query, string $direction = 'desc'): Builder
    {
        return $query->whereStatus(self::STATUS_PUBLISHED)->orderBy('created_at', $direction);
    }
}
