<?php

namespace App\Policies;

use App\User;
use App\News;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the news.
     *
     * @param  App\User  $user
     * @param  App\News  $news
     * @return mixed
     */
    public function view(User $user, News $news)
    {
        return true;
    }

    /**
     * Determine whether the user can create news.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the news.
     *
     * @param  App\User  $user
     * @param  App\News  $news
     * @return mixed
     */
    public function update(User $user, News $news)
    {
        if($user->teacher()) {
            return true;
        }

        return $user->id === $news->author_id;
    }

    /**
     * Determine whether the user can delete the news.
     *
     * @param  App\User  $user
     * @param  App\News  $news
     * @return mixed
     */
    public function delete(User $user, News $news)
    {
        if($user->teacher()) {
            return true;
        }
        return $user->id === $news->author_id;
    }
}
