<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

/**
 * @OA\Info(title="My First API", version="0.1")
 */
class ArticleController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/articles",
     *      operationId="getProjectsList",
     *      tags={"Projects"},
     *      summary="Get list of projects",
     *      description="Returns list of projects",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        return Article::all();
    }

    // public function show($id)
    // {
    //     return Article::find($id);
    // }

    public function show(Article $article)
    {
        return $article;
    }


    public function store(Request $request)
    {
        $article = Article::create($request->all());
        return response()->json($article, 201);
    }

    // public function update(Request $request, $id)
    // {
    //     $article = Article::findOrFail($id);
    //     $article->update($request->all());

    //     return $article;
    // }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        return response()->json($article, 200);
    }

    // public function delete(Request $request, $id)
    // {
    //     $article = Article::findOrFail($id);
    //     $article->delete();

    //     return 204;
    // }
    public function delete(Article $article)
    {
        $article->delete();

        return response()->json(null, 204);
    }
}
