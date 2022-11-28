<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int $role_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * Relations
 * @property Collection $articles
 * @property Role $role
 * @property Comment $comments
 * @property Collection $history
 *
 * @mixin IdeHelperUser
 */
class User extends Model implements Authenticatable, CanResetPassword
{
    use HasFactory;
    use Notifiable;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
    ];

    /**
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    /**
     * @return HasOne
     */
    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'author_id');
    }

    /**
     * @return HasMany
     */
    public function history(): HasMany
    {
        return $this->hasMany(ArticleHistory::class, 'author_id')->orderBy('created_at', 'desc');
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthIdentifierName(): string
    {
        return 'id';
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthIdentifier(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthPassword(): string
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function getRememberToken(): ?string
    {
        return $this->remember_token;
    }

    /**
     * {@inheritdoc}
     */
    public function setRememberToken($value)
    {
        return $this->remember_token = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getRememberTokenName(): string
    {
        return 'remember_token';
    }

    /**
     * {@inheritdoc}
     */
    public function getEmailForPasswordReset(): string
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    /**
     * @param string $password
     * @return void
     */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role_id === Role::ADMIN;
    }

    /**
     * @return bool
     */
    public function isNotAdmin(): bool
    {
        return !$this->isAdmin();
    }
}
