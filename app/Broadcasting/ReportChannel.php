<?php

namespace App\Broadcasting;

use App\Models\User;

/**
 * Class ReportChannel
 * @package App\Broadcasting
 */
class ReportChannel
{
    /**
     * Authenticate the user's access to the channel.
     *
     * @param User $user
     * @param int $id
     * @return bool
     */
    public function join(User $user, int $id): bool
    {
        return $user->isAdmin() && ($user->id === $id);
    }
}
