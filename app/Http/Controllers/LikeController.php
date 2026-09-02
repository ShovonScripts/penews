<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request, Article $article): JsonResponse
    {
        $user = $request->user();

        if ($user->likedArticles()->where('article_id', $article->id)->exists()) {
            $user->likedArticles()->detach($article->id);
            $liked = false;
        } else {
            $user->likedArticles()->attach($article->id);
            $liked = true;
        }

        $count = $article->likedByUsers()->count();

        return response()->json([
            'liked' => $liked,
            'count' => $count,
        ]);
    }
}
