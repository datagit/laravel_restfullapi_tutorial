<?php

namespace App\Http\Controllers\Auth;

// DON'T FORGET TO ADD THESE TWO!
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

// doc: https://github.com/laravel/framework/blob/6.x/src/Illuminate/Foundation/Auth/RegistersUsers.php
// doc: https://laraveldaily.com/9-things-you-can-customize-in-laravel-registration/
class RegisterController extends Controller
{
    use RegistersUsers;
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    // use RegistersUsers;
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/register",
     *      operationId="postRegister",
     *      summary="Post register user",
     *      description="Returns a user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreUserRequest")
     *      ),
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
    public function register(Request $request)
    {
        // Here the request is validated. The validator method is located
        // inside the RegisterController, and makes sure the name, email
        // password and password_confirmation fields are required.
        $this->validator($request->all())->validate();

        // A Registered event is created and will trigger any relevant
        // observers, such as sending a confirmation email or any
        // code that needs to be run as soon as the user is created.
        event(new Registered(($user = $this->create($request->all()))));

        // After the user is created, he's logged in.
        // $this->guard()->login($user);

        // And finally this is the hook that we want. If there is no
        // registered() method or it returns null, redirect him to
        // some other URL. In our case, we just need to implement
        // that method to return the correct response.
        return $this->registered($request, $user) ?:
            redirect($this->redirectPath());
    }
    protected function registered(Request $request, $user)
    {
        $user->generateToken();

        return response()->json(['data' => $user->toArray()], 201);
    }
}
