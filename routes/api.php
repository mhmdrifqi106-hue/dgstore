<?php

use App\Http\Controllers\CallbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(CallbackController::class)->prefix('callback')->group(function () {
    Route::post('tokopay', 'callback_tokopay')->name('callback.tokopay');
});
