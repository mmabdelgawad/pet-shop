<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\LogoutAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle logout action
     *
     * @OA\Post(
     *     path="/api/v1/auth/logout",
     *     tags={"Auth"},
     *     operationId="logout",
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *         response=401,
     *         description="Bearer token is missing."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found."
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     * )
     */
    public function __invoke(Request $request, LogoutAction $logoutAction): JsonResponse
    {
        $logoutAction->handle();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
