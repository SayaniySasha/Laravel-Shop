<?php

namespace App\Policies;

use App\User;
use App\Post;

use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }
    
    public function before($user, $ability)
    {
        // if ($user->isAdmin()) {
        //     return true;
        // }

        foreach ($user->roles as $role) {
            if ($role->name == 'Admin') {
                return true;
            }
        }
        
    }

    public function owner(User $user, Post $post)
    {
        if ($user->id == $post->user_id) {
            return true;
        }
        
        return false;
    }

    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
