<?php

namespace App\Models\Concerns;

trait IsEditor
{
    /**
     * Check if the user is an editor.
     *
     * @return bool True if the user is an editor, otherwise false.
     */
    public function isEditor(): bool
    {
        return $this->is_editor;
    }
}
