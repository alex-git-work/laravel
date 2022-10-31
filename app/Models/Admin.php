<?php

namespace App\Models;

/**
 * Class Admin
 * @package App\Models
 */
class Admin extends User
{
    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail(): string
    {
        return config('mail.admin.address');
    }
}
