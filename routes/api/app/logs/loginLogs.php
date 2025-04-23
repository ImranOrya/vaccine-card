<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\api\app\log\login\EpiLoginLogController;
use App\Http\Controllers\api\app\log\login\FinanceLoginLogController;

Route::get('/testing', [TestController::class, "vaccineCenterStore"]);


Route::prefix('v1')->middleware(["multiAuthorized:" . 'epi:api,finance:api'])->group(function () {
    Route::get('epi/login/logs', [EpiLoginLogController::class, 'userLoginLogs']);
    Route::get('finance/login/logs', [FinanceLoginLogController::class, 'userLoginLogs']);
});
