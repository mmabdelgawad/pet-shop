<?php

use Buckhill\BacsPayment\Http\Controllers\BacsController;

Route::prefix('api')->group(function () {
    Route::post('bacs', BacsController::class);
});
