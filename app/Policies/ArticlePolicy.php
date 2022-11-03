<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

/**
 * Class ArticlePolicy
 * @package App\Policies
 */
class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Article $article
     * @return Response|bool
     */
    public function update(User $user, Article $article): Response|bool
    {
        return $article->author_id === $user->id || $user->isAdmin() ? Response::allow() : Response::deny('Редактировать чужую статью нельзя');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Article $article
     * @return Response|bool
     */
    public function delete(User $user, Article $article): Response|bool
    {
        return $article->author_id === $user->id || $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Article $article
     * @return Response|bool
     */
    public function forceDelete(User $user, Article $article): Response|bool
    {
        return $article->author_id === $user->id || $user->isAdmin();
    }

    /**
     * @param User|null $user
     * @param Article $article
     * @return Response|bool
     */
    public function view(?User $user, Article $article): Response|bool
    {
        $result = true;

        if ($article->isHidden()) {
            $result = $article->author_id === optional($user)->id || optional($user)->isAdmin();
        }

        return $result;
    }
}
