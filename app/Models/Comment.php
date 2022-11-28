<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int $article_id
 * @property int $author_id
 * @property string $body
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * Relations
 * @property User $user
 * @property Article $article
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
        'article_id',
        'author_id',
        'body',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
