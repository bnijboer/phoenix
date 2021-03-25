<?php

namespace App\Models\Concerns;

trait IsOwner
{
    /**
     * Check if the user is the owner.
     *
     * @return bool True if the user is an administrator or editor, otherwise false.
     */
    public function isOwner(): bool
    {
        return $this->is_admin || $this->is_editor;
    }
}
