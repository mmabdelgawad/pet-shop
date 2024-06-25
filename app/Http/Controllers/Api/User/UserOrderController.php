<?php

namespace App\Http\Controllers\Api\User;

use App\Actions\User\Order\ListUserOrdersAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Order\ListUserOrdersRequest;
use App\Http\Resources\UserOrdersResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserOrderController extends Controller
{
    /**
     * Display user orders list
     *
     * @OA\Post(
     *     path="/api/v1/user/orders",
     *     tags={"User"},
     *     operationId="listUserOrders",
     *     security={{"bearer_token":{}}},
     *     @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *            @OA\Property(
     *              description="Page limit",
     *              property="limit",
     *              type="string",
     *            ),
     *            @OA\Property(
     *              description="Page number",
     *              property="page",
     *              type="string",
     *            ),
     *            @OA\Property(
     *              description="Sort by",
     *              property="sortBy",
     *              type="string",
     *            ),
     *            @OA\Property(
     *              description="Sort type",
     *              property="sort",
     *              type="string",
     *            ),
     *          )
     *        )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     * )
     */
    public function index(ListUserOrdersRequest $request, ListUserOrdersAction $listUserOrdersAction): AnonymousResourceCollection
    {
        return UserOrdersResource::collection($listUserOrdersAction->handle($request));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        //
    }
}
