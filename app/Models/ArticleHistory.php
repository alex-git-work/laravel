<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * This is the model class for table "article_histories".
 *
 * @property int $id
 * @property int $article_id
 * @property int $author_id
 * @property array $old
 * @property array $current
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * Relations
 * @property User $user
 * @property Article $article
 */
class ArticleHistory extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'article_id',
        'author_id',
        'old',
        'current',
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'old' => 'array',
        'current' => 'array'
    ];

    /**
     * @return BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
