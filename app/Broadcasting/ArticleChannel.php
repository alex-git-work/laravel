<?php

namespace App\Broadcasting;

use App\Models\User;

/**
 * Class ArticleChannel
 * @package App\Broadcasting
 */
class ArticleChannel
{
    /**
     * Authenticate the user's access to the channel.
     *
     * @param User $user
     * @return bool
     */
    public function join(User $user): bool
    {
        return $user->isAdmin();
    }
}
