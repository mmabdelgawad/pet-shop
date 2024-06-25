<?php

namespace App\Http\Controllers\Api;

use App\Actions\Promotion\ListPromotionAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Promotion\ListPromotionRequest;
use App\Http\Resources\PromotionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PromotionController extends Controller
{
    /**
     * Display promotions list
     *
     * @OA\Post(
     *     path="/api/v1/promotions",
     *     tags={"Promotion"},
     *     operationId="listPromotions",
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
     *            @OA\Property(
     *              description="Valid",
     *              property="valid",
     *              type="boolean",
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
    public function index(ListPromotionRequest $request, ListPromotionAction $listPromotionAction): AnonymousResourceCollection
    {
        return PromotionResource::collection($listPromotionAction->handle($request));
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
