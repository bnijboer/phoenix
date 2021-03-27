<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  User  $user
     * @return mixed
     */
    public function before(User $user)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Comment  $comment
     * @return mixed
     */
    public function restore(User $user, Comment $comment)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Comment  $comment
     * @return mixed
     */
    public function forceDelete(User $user, Comment $comment)
    {
        return false;
    }
}
