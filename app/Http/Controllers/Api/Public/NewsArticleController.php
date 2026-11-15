<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsArticleResource;
use App\Models\NewsArticle;

class NewsArticleController extends Controller
{
    public function index()
    {
        $articles = NewsArticle::where('is_published', true)->latest()->get();
        return NewsArticleResource::collection($articles);
    }

    public function show($id)
    {
        $article = NewsArticle::where('is_published', true)
            ->where(function ($query) use ($id) {
                $query->where('slug', $id);
                if (is_numeric($id)) {
                    $query->orWhere('id', (int) $id);
                }
            })
            ->firstOrFail();

        return new NewsArticleResource($article);
    }
}
