<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if($user->hasRole(['admin', 'editor'])) {
            return true;
        }
    }

    public function view(User $user, Post $post)
    {
        if($user->hasRole(['admin', 'editor'])) {
            return true;
        }
    }

    public function create(User $user)
    {
        if($user->hasRole(['admin', 'editor'])) {
            return true;
        }
    }

    public function update(User $user, Post $post)
    {
        if($user->hasRole(['admin', 'editor'])) {
            return true;
        }
    }

    public function delete(User $user, Post $post)
    {
        if($user->hasRole(['admin'])) {
            return true;
        }
    }

}
