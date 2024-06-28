<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\ResetPasswordAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use Illuminate\Http\JsonResponse;

class ResetPasswordController extends Controller
{
    /**
     * Handle reset password action
     *
     * @OA\Post(
     *     path="/api/v1/auth/reset-password",
     *     tags={"Auth"},
     *     operationId="resetPassword",
     *     @OA\RequestBody(
     *     @OA\MediaType(
     *         mediaType="multipart/form-data",
     *         @OA\Schema(
     *           required={"token", "email", "password", "password_confirmation"},
     *           @OA\Property(
     *             description="Password reset token",
     *             property="token",
     *             type="string",
     *           ),
     *           @OA\Property(
     *             description="User email",
     *             property="email",
     *             type="string",
     *           ),
     *           @OA\Property(
     *             description="New password",
     *             property="password",
     *             type="string",
     *           ),
     *           @OA\Property(
     *             description="New password confirmation",
     *             property="password_confirmation",
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
    public function __invoke(ResetPasswordRequest $request, ResetPasswordAction $resetPasswordAction): JsonResponse
    {
        $resetPasswordAction->handle($request);

        return response()->json([
            'message' => 'Password successfully updated.',
        ]);
    }
}
