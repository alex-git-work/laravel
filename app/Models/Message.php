<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property string $email
 * @property string $body
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @mixin IdeHelperMessage
 */
class Message extends Model
{
    use HasFactory;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'email',
        'body',
    ];

    /**
     * @return Attribute
     */
    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::lower($value),
        );
    }
}
