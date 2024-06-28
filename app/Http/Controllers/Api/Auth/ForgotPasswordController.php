<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\ForgotPasswordAction;
use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ForgotPasswordRequest;
use Illuminate\Http\JsonResponse;

class ForgotPasswordController extends Controller
{
    /**
     * Handle forgot password action
     *
     * @throws UserException
     *
     * @OA\Post(
     *     path="/api/v1/auth/forgot-password",
     *     tags={"Auth"},
     *     operationId="forgotPassword",
     *     @OA\RequestBody(
     *     @OA\MediaType(
     *         mediaType="multipart/form-data",
     *         @OA\Schema(
     *           required={"email"},
     *           @OA\Property(
     *             description="User email",
     *             property="email",
     *             type="string",
     *           ),
     *         )
     *       )
     *    ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     * )
     */
    public function __invoke(ForgotPasswordRequest $request, ForgotPasswordAction $forgotPasswordAction): JsonResponse
    {
        return response()->json([
            'token' => $forgotPasswordAction->handle($request),
        ]);
    }
}
