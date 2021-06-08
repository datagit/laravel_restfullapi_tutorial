<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Store Article request",
 *      description="Store Article request body data",
 *      type="object",
 *      required={"title"}
 * )
 */
class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts|max:255',
        ];
    }

    /**
     * @OA\Property(
     *      title="title",
     *      description="title of the new article",
     *      example="title 01"
     * )
     *
     * @var string
     */
    public $title;
    /**
     * @OA\Property(
     *      title="body",
     *      description="body of the new article",
     *      example="body 01"
     * )
     *
     * @var string
     */
    public $body;
}
