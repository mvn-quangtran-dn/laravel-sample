<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;


class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return response()->json($articles, 200);
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return response()->json($article, 200);
    }

    public function store(Request $request)
    {
        $article = Article::create($request->all());
        return response()->json($article, 201);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());

        return response()->json($article, 200);
    }

    public function destroy(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(null, 204);
    }
}
