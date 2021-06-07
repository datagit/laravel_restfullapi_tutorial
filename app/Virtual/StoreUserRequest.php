<?php
/**
 * @OA\Schema(
 *      title="Store User request",
 *      description="Store User request body data",
 *      type="object",
 *      required={"name"}
 * )
 */

class StoreUserRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new user",
     *      example="A nice user name"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="email",
     *      description="email of the new user",
     *      example="This is new user's email"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="password of the new user",
     *      format="string",
     *      example=123456
     * )
     *
     * @var string
     */
    public $password;

    /**
     * @OA\Property(
     *      title="password_confirmation",
     *      description="password_confirmation of the new user",
     *      format="string",
     *      example=123456
     * )
     *
     * @var string
     */
    public $password_confirmation;
}
