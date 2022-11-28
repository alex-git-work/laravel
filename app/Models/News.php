<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @method static Model create(array $attributes)
 */
class News extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'title',
        'body',
    ];
}
