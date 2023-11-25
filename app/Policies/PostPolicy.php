<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        if ($user->role == 'superadmin') {
            // Superadmin can see all posts
            return true;
        } elseif ($user->role == 'admin') {
            // Admin can see their own posts and posts by users
            return $user->id === $post->user_id || $post->user->role == 'user';
        } elseif ($user->role == 'user') {
            // User can only see their own posts
            return $user->id === $post->user_id;
        }
        return false;
        
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        if ($user->role == 'superadmin') {
            // Superadmin can see all posts
            return true;
        } elseif ($user->role == 'admin') {
            // Admin can see their own posts and posts by users
            return $user->id === $post->user_id || $post->user->role == 'user';
        } elseif ($user->role == 'user') {
            // User can only see their own posts
            return $user->id === $post->user_id;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        if ($user->role == 'superadmin') {
            // Superadmin can see all posts
            return true;
        } elseif ($user->role == 'admin') {
            // Admin can see their own posts and posts by users
            return $user->id === $post->user_id || $post->user->role == 'user';
        } elseif ($user->role == 'user') {
            // User can only see their own posts
            return $user->id === $post->user_id;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        //
    }
}
