<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\Models\User|null $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function index(?User $user, Post $post)
    {
        if ($post->enable) {
            return true;
        }

        // visitors cannot view unpublished items
        if ($user === null) {
            return false;
        }

        // admin overrides published status
        if ($user->can('View Post')) {
            return true;
        }
        if (auth()->check() && $user->hasAnyRole(['editor', 'viewer', 'admin', 'super'])) {
            return true;
        }

        // authors can view their own unpublished posts
        return  $user->id == $post->user_id;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

        if (auth()->check() && $user->hasAnyRole(['admin', 'super','editor']) && auth()->user->can('Create Post')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {

        if ($user->hasAnyRole(['admin', 'super']) && auth()->user->can('Update Post')) {
            return true;
        }
        if (auth()->check() && $user->hasRole('editor') && auth()->user->can('Update Post') && auth()->id() == $post->user_id) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        if ($user->hasAnyRole(['admin', 'super'])&& auth()->user->can('Delete Post')) {
            return true;
        }
        return auth()->check() && $user->hasRole('editor') && auth()->user->can('Delete Post')  && auth()->id() == $post->user_id;
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        if (auth()->check() && $user->hasRole('super')) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        if (auth()->check() && $user->hasRole('super')) {
            return true;
        }
    }
}
