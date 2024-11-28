<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function update(User $user, Post $post)
{
    return $user->id === $post->user_id;
}
}
