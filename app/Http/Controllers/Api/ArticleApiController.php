<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;

// doc for guide: -> https://github.com/DarkaOnLine/L5-Swagger/issues/318
/**
 * @SWG\SecurityScheme(
*       securityDefinition="APIKeyHeader",
*       type="apiKey",
*       in="header",
*       name="Authentication",
*       )
 * @OA\Info(title="My First API1", version="0.1.1")
 * @OAS\SecurityScheme(
 *      securityScheme="api_key_security_example",
 *      type="apiKey",
 *      scheme="bearer"
 * )
 */
class ArticleApiController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/articles",
     *      operationId="getArticles",
     *      summary="Get list of articles",
     *      description="Returns list of articles",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation")
     *       ),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
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
