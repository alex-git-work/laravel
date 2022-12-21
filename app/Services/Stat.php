<?php

namespace App\Services;

use App\Models\Article;
use App\Models\News;
use App\Models\User;

/**
 * Class Stat
 * @package App\Services
 */
class Stat
{
    public const CACHE_TTL = 1 * 10 * 60;
    public const CACHE_KEY_STAT = 'stat';
    public const CACHE_TAGS = [
        'stat',
        'article',
        'news',
        'comment',
    ];

    /**
     * @return array
     */
    public static function getData(): array
    {
        return [
            'articlesQty' => self::articlesQty(),
            'maxArticleLength' => self::maxArticleLength(),
            'minArticleLength' => self::minArticleLength(),
            'historyMax' => self::historyMax(),
            'commentsMax' => self::commentsMax(),
            'maxArticlesUser' => self::maxArticlesUser(),
            'articlesAvg' => self::articlesAvg(),
            'news' => self::news(),
        ];
    }

    /**
     * @return array
     */
    public static function articlesQty(): array
    {
        return Article::selectRaw(
            'COUNT(*) as total,
            SUM(status = ' . Article::STATUS_PUBLISHED . ') as published,
            SUM(status = ' . Article::STATUS_HIDDEN . ') as hidden'
        )->first()->toArray();
    }

    /**
     * @return Article
     */
    public static function maxArticleLength(): Article
    {
        return Article::selectRaw('*, LENGTH(body) as length')
            ->where('status', '=', Article::STATUS_PUBLISHED)
            ->orderBy('length', 'desc')
            ->first();
    }

    /**
     * @return Article
     */
    public static function minArticleLength(): Article
    {
        return Article::selectRaw('*, LENGTH(body) as length')
            ->where('status', '=', Article::STATUS_PUBLISHED)
            ->orderBy('length')
            ->first();
    }

    /**
     * @return Article
     */
    public static function historyMax(): Article
    {
        return Article::where('status', '=', Article::STATUS_PUBLISHED)
            ->withCount('history')
            ->orderBy('history_count', 'desc')
            ->first();
    }

    /**
     * @return Article
     */
    public static function commentsMax(): Article
    {
        return Article::where('status', '=', Article::STATUS_PUBLISHED)
            ->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->first();
    }

    /**
     * @return User
     */
    public static function maxArticlesUser(): User
    {
        return User::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->first();
    }

    /**
     * @return float
     */
    public static function articlesAvg(): float
    {
        return User::withCount('articles')
            ->having('articles_count', '>', 1)
            ->get()
            ->avg('articles_count');
    }

    /**
     * @return int
     */
    public static function news(): int
    {
        return News::count();
    }
}
