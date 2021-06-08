<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests\StoreArticleRequest;

// doc for guide: -> https://github.com/DarkaOnLine/L5-Swagger/issues/318
/**
 * * @OA\Info(
 *      version="1.0.0",
 *      title="L5 OpenApi",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="darius@matulionis.lt"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @SWG\SecurityScheme(
 *       securityDefinition="APIKeyHeader",
 *       type="apiKey",
 *       in="header",
 *       name="Authentication",
 *       )
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

    /**
     * @OA\Get(
     *      path="/api/articles/{article}",
     *      operationId="showArticles",
     *      summary="Get detail of article",
     *      description="Returns a detail of article",
     * @OA\Parameter(
     *          name="article",
     *          description="article id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
    public function show(Article $article)
    {
        return $article;
    }

    /**
     * @OA\Post(
     *      path="/api/articles",
     *      operationId="storeArticles",
     *      summary="Post a articles",
     *      description="Returns a articles",
     * @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreArticleRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation")
     *       )
     *     )
     */
    public function store(StoreArticleRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        if ($validated) {
            $article = Article::create($request->all());
            return response()->json($article, 201);
        }
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
