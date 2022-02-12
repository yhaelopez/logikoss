<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if($user->hasRole(['admin', 'editor'])) {
            return true;
        }
    }

    public function view(User $user, User $model)
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

    public function update(User $user, User $model)
    {
        if($user->hasRole(['admin', 'editor'])) {
            return true;
        }
    }

    public function delete(User $user, User $model)
    {
        if($user->hasRole(['admin'])) {
            return true;
        }
    }
}
