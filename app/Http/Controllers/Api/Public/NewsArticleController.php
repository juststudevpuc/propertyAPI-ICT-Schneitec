<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use App\Http\Resources\NewsArticleResource;

class NewsArticleController extends Controller
{
    public function index()
    {
        $articles = NewsArticle::where('is_published', true)->latest()->get();
        return NewsArticleResource::collection($articles);
    }

    public function show($id)
    {
        $article = NewsArticle::where('is_published', true)->findOrFail($id);
        return new NewsArticleResource($article);
    }
}
