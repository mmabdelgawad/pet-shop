<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\LoginAction;
use App\Exceptions\Auth\AuthException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\UserResource;

/**
 * @OA\Info(title="Petshop API", version="1.0")
 */
class LoginController extends Controller
{
    /**
     * Handle login action
     *
     * @throws AuthException
     *
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     tags={"Auth"},
     *     operationId="login",
     *     @OA\RequestBody(
     *     @OA\MediaType(
     *         mediaType="multipart/form-data",
     *         @OA\Schema(
     *           required={"email", "password"},
     *           @OA\Property(
     *             description="User email",
     *             property="email",
     *             type="string",
     *           ),
     *           @OA\Property(
     *             description="User password",
     *             property="password",
     *             type="string",
     *           ),
     *         )
     *       )
     *    ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials."
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     * )
     */
    public function __invoke(LoginRequest $request, LoginAction $action): UserResource
    {
        [$token, $user] = $action->handle($request->validated());

        return UserResource::make($user)->setToken($token);
    }
}
