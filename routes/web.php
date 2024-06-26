<?php

use Illuminate\Support\Facades\Route;

Route::get('/{vue_capture?}', function () {
    return view('frontend');
})->where('vue_capture', '[\/\w\.-]*');
