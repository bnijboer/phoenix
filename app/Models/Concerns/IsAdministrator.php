<?php

namespace App\Models\Concerns;

trait IsAdministrator
{
    /**
     * Check if the user is an administrator.
     *
     * @return bool True if the user is an administrator, otherwise false.
     */
    public function isAdministrator(): bool
    {
        return $this->is_admin;
    }
}
