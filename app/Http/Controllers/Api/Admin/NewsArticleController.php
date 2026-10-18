<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNewsArticleRequest;
use App\Http\Requests\Admin\UpdateNewsArticleRequest;
use App\Models\NewsArticle;
use Illuminate\Http\JsonResponse;

class NewsArticleController extends Controller
{
    public function index(): JsonResponse {
        return response()->json(['data' => NewsArticle::latest()->get()]);
    }

    public function store(StoreNewsArticleRequest $request): JsonResponse {
        return response()->json(['message' => 'Article created.', 'data' => NewsArticle::create($request->validated())], 201);
    }

    public function show(NewsArticle $newsArticle): JsonResponse {
        return response()->json(['data' => $newsArticle]);
    }

    public function update(UpdateNewsArticleRequest $request, NewsArticle $newsArticle): JsonResponse {
        $newsArticle->update($request->validated());
        return response()->json(['message' => 'Article updated.', 'data' => $newsArticle]);
    }

    public function destroy(NewsArticle $newsArticle): JsonResponse {
        $newsArticle->delete();
        return response()->json(['message' => 'Article deleted.']);
    }
}
