<?php

namespace Buckhill\BacsPayment\Http\Controllers;

use Buckhill\BacsPayment\Bacs\BacsRecordsBuilder;
use Buckhill\BacsPayment\Http\Requests\BacsPaymentRequest;

/**
 * @OA\Info(title="BACS Payment API", version="1.0")
 */
class BacsController
{
    /**
     * Handle bacs payment action
     *
     * @OA\Post(
     *     path="/api/bacs",
     *     tags={"Bacs Payment"},
     *     operationId="bacs",
     *     @OA\RequestBody(
     *     @OA\MediaType(
     *         mediaType="multipart/form-data",
     *         @OA\Schema(
     *           required={"vol.owner_id", "vol.owner_id_no", "hdr1.file_creation_date", "hdr1.file_expiration_date"},
     *           @OA\Property(
     *             description="Vol record (owner id)",
     *             property="vol.owner_id",
     *             type="string",
     *           ),
     *           @OA\Property(
     *             description="Vol record (owner id no)",
     *             property="vol.owner_id_no",
     *             type="string",
     *           ),
     *          @OA\Property(
     *             description="Hdr1 record (file creation date)",
     *             property="hdr1.file_creation_date",
     *             type="string",
     *          ),
     *          @OA\Property(
     *             description="Hdr1 record (file expiration date)",
     *             property="hdr1.file_expiration_date",
     *             type="string",
     *           )
     *         )
     *       )
     *    ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     * )
     */
    public function __invoke(BacsPaymentRequest $request, BacsRecordsBuilder $bacsRecordBuilder)
    {
        $bacsRecords = $bacsRecordBuilder->build($request->validated());

        return response([
            'message' => 'BACS payment request has been successfully processed',
            'data' => [...$bacsRecords],
        ]);
    }
}
